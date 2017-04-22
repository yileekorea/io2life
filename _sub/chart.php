<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>chart test</title>
</head> 
<body>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://code.highcharts.com/stock/highstock.js"></script>
<script src="https://code.highcharts.com/stock/modules/exporting.js"></script>



<div id="container" style="height: 400px; min-width: 310px"></div>

</body>
</html>


<script>

var seriesOptions = []
    //seriesCounter = 0,
    //names = ['MSFT', 'AAPL', 'GOOG'];

/**
 * Create the chart when all data is loaded
 * @returns {undefined}
 */
function createChart() {

    Highcharts.stockChart('container', {

        rangeSelector: {
            selected: 4
        },

        yAxis: {
            labels: {
                formatter: function () {
                    return (this.value > 0 ? ' + ' : '') + this.value + '%';
                }
            },
            plotLines: [{
                value: 0,
                width: 2,
                color: 'silver'
            }]
        },

        plotOptions: {
            series: {
                compare: 'percent',
                showInNavigator: true
            }
        },

        tooltip: {
            pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> ({point.change}%)<br/>',
            valueDecimals: 2,
            split: true
        },

        series: seriesOptions
    });
}

	$.getJSON("./data_4_n.php", function(data) {
			for( i=0; i<((data[0]['num_sensors'])-1); i++) {
				seriesOptions[i] = {
									name: name,
									data: data
				};
				seriesOptions[i].name = data[i]['name'];
				seriesOptions[i].data = data[i]['data'];
			}
			//chart = new Highcharts.Chart(options);
            createChart();			
		});

/*
$.each(names, function (i, name) {

    $.getJSON('https://www.highcharts.com/samples/data/jsonp.php?filename=' + name.toLowerCase() + '-c.json&callback=?',    function (data) {
	//$.getJSON("./data_4_n.php", function(json) {

        seriesOptions[i] = {
            name: name,
            data: data
        };

        // As we're loading the data asynchronously, 
		//we don't know what order it will arrive. 
		//So, we keep a counter and create the chart 
		//when all the data is loaded.
        seriesCounter += 1;
		


        if (seriesCounter === names.length) {
            createChart();
        }
    });
});
*/
</script>


