<html>
<head>
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
                ['Assunto', 'Quantidade'],
                @php
                $index = 0;
                foreach ($natureza->assunto as $assunto){
                    ++$index;
                    $label = strtolower(substr($natureza->descricao, 0, 1));
                    $count = \App\Models\AssuntoAnalitica::where('assunto_id', $assunto->assunto_id)->count();
                    echo "['". $label.$index."', $count],\n";
                }
                @endphp
                ],
                false); // 'false' means that the first row contains labels, not data.

            // Set chart options
            var options = {
                title: ' {{ $natureza->descricao }}',
                titleTextStyle: {
                    fontSize: 20,
                },
                width: 500,
                height: 500,
                legend: {
                    position: "none"
                },
                hAxis: {
                    title: 'Assunto',
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
            };

            // Instantiate and draw our chart, passing in some options.
            var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }
    </script>
</head>

<body>
<!--Div that will hold the pie chart-->
<div id="chart_div">
</div>
</body>
</html>
