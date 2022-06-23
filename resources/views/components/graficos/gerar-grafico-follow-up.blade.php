@include('common._head')
<div>
    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

        // Load the Visualization API and the corechart package.
        google.charts.load('current', {'packages':['corechart']});

        // Set a callback to run when the Google Visualization API is loaded.
        google.charts.setOnLoadCallback(drawChart);

        // Callback that creates and populates a data table,
        // instantiates the pie chart, passes in the data and
        // draws it.
        function drawChart() {
            // Create the data table.
            var data = google.visualization.arrayToDataTable([
                    ['Follow-up', 'Quantidade'],
                    ['Efetuado', {{ $follow_up_sim }}],
                    ['Não Efetuado', {{ $follow_up_nao }}],
                ],
                false); // 'false' means that the first row contains labels, not data.

            // Set chart options
            var options = {
                title: 'Follow-up',
                titleTextStyle: {
                    fontSize: 20,
                    italic: true
                },
                width: 'auto',
                height: 500,
                is3D: true,
                sliceVisibilityThreshold: 0,
                pieSliceText: 'value'
            };

            // Instantiate and draw our chart, passing in some options.
            var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }
    </script>
</div>

<div id="chart_div"></div>
<div class="w3-row-padding w3-section w3-center">
    <x-botao-tabela function="Voltar"></x-botao-tabela>
</div>
