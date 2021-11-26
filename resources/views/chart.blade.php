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
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Reported Numbers');
        data.addColumn('number', 'Violence Types');
        data.addRows([
          ['Psychological Violence', 45],
          ['Stalking', 12],
          ['Physical Violence', 69],
          ['Forced Marriages', 50],
          ['Sexual Violence', 101],
          ['Female Genital Mutilation', 16],
          ['Forced Abortion', 35],
          ['Forced Sterilisation', 5],
          ['Sexual Harassment', 44],
          ['Aiding or Abetting and Attempt', 24],
          ['Others', 19]
        ]);

        // Set chart options
        var options = {'title':'How violence cases are being reported',
                       'width':500,
                       'height':300};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
  </head>

  <body>
    <!--Div that will hold the pie chart-->
    <div id="chart_div"></div>
  </body>
</html>