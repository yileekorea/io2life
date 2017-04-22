function buildChart(data){
	var seriesOptions = [],
		seriesCounter = 0,
		colors = Highcharts.getOptions().colors;
		
		dataLength = data[0].length;
		var today = data[0][dataLength-1][0];
		var namearray = new Array();
	for(var i = 0; i < data.length; i++){
		var dataarray = new Array();
		for(var j = 0; j < data[i].length; j++){
			dataarray[j] = new Array();
				dataarray[j][0] = data[i][j][0]; //TS
				dataarray[j][1] = data[i][j][2]; //END VALUE
				namearray[i] = data[i][j][data[i][j].length-2]; //DESCRIPTION
		}
		
		seriesOptions[i] = {
			name: namearray[i],
			data: dataarray
		};
		
		console.log(seriesOptions);
		// As we're loading the data asynchronously, we don't know what order it will arrive. So
		// we keep a counter and create the chart when all the data is loaded.
		seriesCounter++;

		if (seriesCounter == data.length) {
			createChart();
		}

	};

	// create the chart when all data is loaded
	function createChart() {
		var options = {
		    chart: {
		        renderTo: 'line'
		    },
			
			title: {
		        text: $(".item.selected td").first().text()
		    },

		    rangeSelector : {
                buttons: [{
                    type: 'month',
                    count: 1,
                    text: '1M'
                }, {
					type: 'month',
                    count: 6,
                    text: '6M'
                }, {
                    type: 'year',
                    count: 1,
                    text: '1y'
                }, {
					type: 'ytd',
                    text: 'YTD'
                }, {
                    type: 'all',
                    text: 'All'
                }],
                selected : 2 // year
            },
            xAxis: {
                type: 'datetime'
            },
			series: [{
				data: seriesOptions[0].data,
				type: "area"
				
				
			}]
		}  

	

		/* for(var i =0;i <= seriesOptions.length-1;i++)
            {
                var item = seriesOptions[i];

                options.addSeries({
                    "type": "spline",
                    "name": item.name,
                    "data": [item.data]
                });
            }*/
		
		chart = new Highcharts.StockChart(options);
		
		$.each(seriesOptions, function (itemNo, item) {
			chart.addSeries({                        
				name: item.name,
				data: item.data
			}, false);

		});
		chart.redraw();
		
		
	/*$(document).ready(function() {
		var chart;
		chart = new Highcharts.Chart(options);
	 });*/
};
};

var data = 
[[[1041375600000,28.95,28.95,28.95,28.95,0,"Quote"],[1041462000000,29,29.9,28.6,29.9,27300,"Quote"],[1041548400000,30.5,30,29.8,30.8,27700,"Quote"],[1041807600000,30.8,30.3,28.9,30.8,25600,"Quote"],[1041894000000,30.5,30.1,29.1,30.5,41700,"Quote"],[1041980400000,30.1,28.7,28.4,30.1,33400,"Quote"],[1042066800000,28.37,28.5,27.35,28.9,66900,"Quote"]],[[1041375600000,28.95,28.95,28.95,28.95,0,"series2"],[1041462000000,29,29.9,28.6,29.9,27300,"series2"],[1041548400000,30.5,30,29.8,30.8,27700,"series2"],[1041807600000,30.8,30.3,28.9,30.8,25600,"series2"],[1041894000000,30.5,30.1,29.1,30.5,41700,"series2"],[1041980400000,30.1,28.7,28.4,30.1,33400,"series2"],[1042066800000,28.37,28.5,27.35,28.9,66900,"series2"]]];

buildChart(data);

