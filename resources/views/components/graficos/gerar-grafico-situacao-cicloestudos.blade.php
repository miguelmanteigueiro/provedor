@include('common._head')
<div>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawVisualization);

        function drawVisualization() {
            // Some raw data (not necessarily accurate)
            var data = google.visualization.arrayToDataTable([
                ['Natureza', '1º Ciclo', '2º Ciclo', 'Mestrado Integrado', '3º Ciclo'],

                @php
                    foreach ($naturezas as $natureza){
                        $primeiro_ciclo = 0;
                        $segundo_ciclo = 0;
                        $mestrado_integrado = 0;
                        $terceiro_ciclo = 0;
                        if($natureza->assunto->count()){
                            foreach ($solicitacoes as $solicitacao){
                                if($solicitacao->analitica){
                                    if($solicitacao->analitica->assunto_analitica){
                                        foreach ($solicitacao->analitica->assunto_analitica as $aa){
                                            if($natureza->assunto->contains($aa->assunto_id)){
                                                switch ($solicitacao->analitica->getRawOriginal('ciclo_estudos')){
                                                    case '1_ciclo':
                                                        $primeiro_ciclo++;
                                                        break;
                                                    case '2_ciclo':
                                                        $segundo_ciclo++;
                                                        break;
                                                    case 'mestrado_integrado':
                                                        $mestrado_integrado++;
                                                        break;
                                                    case '3_ciclo':
                                                        $terceiro_ciclo++;
                                                        break;
                                                }
                                                break;
                                            }
                                        }
                                    }
                                }
                            }
                            echo "['$natureza->descricao', $primeiro_ciclo, $segundo_ciclo, $mestrado_integrado, $terceiro_ciclo],\n";
                        }
                    }
                @endphp

            ]);

            var options = {
                title : 'Estatísticas por Natureza/Ciclo de Estudos',
                titleTextStyle: {
                    fontSize: 20,
                },
                width: 'auto',
                height: 500,
                hAxis: {
                    title: 'Natureza',
                    titleTextStyle: {
                        fontSize: 13,
                        bold: true,
                        italic: false
                    },
                    format: '0',
                },
                vAxis: {
                    title: 'Quantidade',
                    titleTextStyle: {
                        fontSize: 13,
                        bold: true,
                        italic: false
                    },
                    format: '0',
                },
                seriesType: 'bars',
            };

            var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }
    </script>
</div>

<div id="chart_div"></div>
<div class="w3-row-padding w3-section w3-center">
    <x-botao-tabela function="Voltar"></x-botao-tabela>
</div>
