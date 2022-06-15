<html>
<head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawVisualization);

        function drawVisualization() {
            // Some raw data (not necessarily accurate)
            var data = google.visualization.arrayToDataTable([
                ['Natureza', 'Aconselhamento', 'Orientação', 'Informação', 'Mediação', 'Outro'],

                @php
                foreach ($naturezas as $natureza){
                    $aconselhamento = 0;
                    $orientacao = 0;
                    $informacao = 0;
                    $mediacao = 0;
                    $outro = 0;
                    if($natureza->assunto->count()){
                        foreach ($solicitacoes as $solicitacao){
                            if($solicitacao->analitica){
                                if($solicitacao->analitica->assunto_analitica){
                                    foreach ($solicitacao->analitica->assunto_analitica as $aa){
                                        if($natureza->assunto->contains($aa->assunto_id)){
                                            switch ($solicitacao->analitica->getRawOriginal('tipo_solicitacao')){
                                                case 'aconselhamento':
                                                    $aconselhamento++;
                                                    break;
                                                case 'orientacao':
                                                    $orientacao++;
                                                    break;
                                                case 'informacao':
                                                    $informacao++;
                                                    break;
                                                case 'mediacao':
                                                    $mediacao++;
                                                    break;
                                                case 'outro':
                                                    $outro++;
                                                    break;
                                            }
                                            break;
                                        }
                                    }
                                }
                            }
                        }
                        echo "['$natureza->descricao', $aconselhamento, $orientacao, $informacao, $mediacao, $outro],\n";
                    }
                }
                @endphp

            ]);

            var options = {
                title : 'Estatísticas por Natureza/Tipologia',
                titleTextStyle: {
                    fontSize: 20,
                },
                width: 1000,
                height: 500,
                hAxis: {
                    title: 'Natureza',
                    titleTextStyle: {
                        fontSize: 13,
                        bold: true,
                        italic: false
                    }
                },
                vAxis: {
                    title: 'Quantidade',
                    titleTextStyle: {
                        fontSize: 13,
                        bold: true,
                        italic: false
                    }
                },
                seriesType: 'bars',
            };

            var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }
    </script>
</head>
<body>
<div id="chart_div"></div>
</body>
</html>
