@include('common._head')
<div>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawVisualization);

        function drawVisualization() {
            // Some raw data (not necessarily accurate)
            var data = google.visualization.arrayToDataTable([
                ['Natureza', 'Masculino', 'Feminino', 'Outro'],

                @php
                    foreach ($naturezas as $natureza){
                        $masculino = 0;
                        $feminino = 0;
                        $outro = 0;
                        if($natureza->assunto->count()){
                            foreach ($solicitacoes as $solicitacao){
                                if($solicitacao->analitica){
                                    if($solicitacao->analitica->assunto_analitica){
                                        foreach ($solicitacao->analitica->assunto_analitica as $aa){
                                            if($natureza->assunto->contains($aa->assunto_id)){
                                                switch ($solicitacao->analitica->getRawOriginal('genero')){
                                                    case 'masculino':
                                                        $masculino++;
                                                        break;
                                                    case 'feminino':
                                                        $feminino++;
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
                            echo "['$natureza->descricao', $masculino, $feminino, $outro],\n";
                        }
                    }
                @endphp

            ]);

            var options = {
                title : 'Estatísticas por Natureza/Género',
                titleTextStyle: {
                    fontSize: 20,
                },
                width: 'auto',
                height: 500,
                hAxis: {
                    title: 'Natureza',
                    titleTextStyle: {
                        fontSize: 16,
                    },
                },
                vAxis: {
                    title: 'Número de Solicitações',
                    titleTextStyle: {
                        fontSize: 16,
                    },
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
