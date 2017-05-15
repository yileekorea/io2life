var options,
	seriesOptions = [];


  $(document).ready(function() {
	    options = {
			chart: {
					renderTo: 'container_ir',
					type: 'line'
            },
			title: {
					text: ''
			},
			subtitle: {
					text: ''
			},
			xAxis: {
					//categories: [],
					type: 'datetime',
					labels: {
					align: 'center',
					x: -3,
					y: 20,
					formatter: function() {
	//						return Highcharts.dateFormat('%l%p', Date.parse(this.value +' UTC'));
	//						return Highcharts.dateFormat('%l%p', (this.value)*1000);
	//						return (Date(this.value));
							return Highcharts.dateFormat('%H:%M',(this.value));
						}
					}
			},
			yAxis: [{
				title: {
					text: 'Temperature ( °C)'
				},
					min: 10,
					max: 40
				},
				{
				title: {
					text: 'INPUT Status'
				},
					min: 10,
					max: 40,
					gridLineWidth: 0,
					opposite: true
			}],
			tooltip: {
				headerFormat: '<b>{series.name}</b><br>',
				pointFormat: '({point.x:%d %b %H:%M:%S}) ==> {point.y:.2f} °C'
							//formatter: function() {
							//return '<b>'+ this.series.name +'</b><br/>'+
							//(this.x) +':: '+ this.y +'°C';
							//}
			},
			
		plotOptions: {
				line: {
					marker: {
					enabled: false
					}
				}
        },

        series: seriesOptions
/*
		series: [{
				type: 'line',
				name: '',
				data: []
	   },
	   {
				type: 'line',
				name: '',
				data: []
	   },
	   {
				type: 'line',
				name: '',
				data: []
	   },
	   {
				type: 'line',
				name: '',
				data: []
	   },
	   {
				type: 'line',
				name: '',
				data: []
	   },
	   {
				type: 'line',
				name: '',
				data: []
	   },
	   {
				type: 'line',
				name: '',
				data: []
	   },
		{
				type: 'line',
				name: '',
				data: []
	   }]
*/
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
			chart = new Highcharts.Chart(options);
		});
/*
	$.getJSON("./data_4_n.php", function(json) {
			for( i=0; i<((json[0]['num_sensors'])-1); i++) {
				options.series[i].name = json[i]['name'];
				options.series[i].data = json[i]['data'];
			}
			chart = new Highcharts.Chart(options);			
		});
*/
	});

    $(function() {
	    $( "#datepicker" ).datepicker({
		  dateFormat: "yy-mm-dd",
	      showOn: "button",
	      buttonImage: "calendar.gif",
	      buttonImageOnly: true,
	      onSelect: function(dateText, inst) { 
		  	
	        $.getJSON("./data_4_n.php?dateParam="+dateText, function(json){
				for( i=0; i<((json[0]['num_sensors'])-2); i++) {
					options.series[i].name = json[i]['name'];
					options.series[i].data = json[i]['data'];
				}
	        	chart = new Highcharts.Chart(options);

			});
	      }
	    });
  	});
 	
//]]> 
      
var options_2;
//var num_sensors;

//<![CDATA[
//$(function () {
//    Highcharts.chart('container_ir2', {
$(document).ready(function() {
	    options_2 = {	
				chart: {
					renderTo: 'container_ir2',
					type: 'line'
				},
				title: {
					text: ''
				},
				subtitle: {
					text: ''
				},
				xAxis: {
					type: 'datetime',
//					dateTimeLabelFormats: { // don't display the dummy year
//						month: '%e. %b',
//						year: '%Y'
					dateTimeLabelFormats: {
					   day: '%d %b %Y'    //ex- 01 Jan 2016
					},
					title: {
						text: 'Date'
					}
				},
				yAxis: {
					title: {
						text: 'Temperature (°C)'
					},
					min: 15
				},
				tooltip: {
					headerFormat: '<b>{series.name}</b><br>',
//					pointFormat: '{point.x:%e. %b}: {point.y:.2f} °C'
					pointFormat: '({point.x:%d %b %H:%M:%S})-> {point.y:.2f} °C'
				},

				plotOptions: {
					line: {
						marker: {
							enabled: false
						}
					}
				},
				series: [{
						type : 'line',
						data: []
					},
					{
						type : 'column',
						data: []
					}]

		};			
/*
			Highcharts.setOptions({
				global: {
					timezoneOffset: -8.5 * 60
				}
			});
*/	
/*			$.getJSON("./data_4_n.php", function ir2 (json) {
				for(var i=0; i<2; i++) {
					options_2.series[i].name = json[(num_sensors-2+i)]['name'];
					options_2.series[i].data = json[(num_sensors-2+i)]['data'];
				}
*/
			$.getJSON("./data_4_n.php", function ir2 (json) {
//				for( i=((json[0]['num_sensors_2'])-2); i<(json[0]['num_sensors_2']); i++) {
				for(var i=0; i<2; i++) {
					options_2.series[i].name = json[((json[0]['num_sensors'])-(2-i))]['name'];
					options_2.series[i].data = json[((json[0]['num_sensors'])-(2-i))]['data'];
				}
/*
				options_2.series[0].name = json[4]['name'];
				options_2.series[0].data = json[4]['data'];
				options_2.series[1].name = json[5]['name'];
				options_2.series[1].data = json[5]['data'];
*/
				chart = new Highcharts.Chart(options_2);			
			});

});
//]]> 
    $(function() {
	    $( "#datepicker_2" ).datepicker({
		  dateFormat: "yy-mm-dd",
	      showOn: "button",
	      buttonImage: "calendar.gif",
	      buttonImageOnly: true,
	      onSelect: function(dateText, inst) { 
		  
	        $.getJSON("./data_4_n.php?dateParam="+dateText, function(json){
				for(var i=0; i<2; i++) {
					options_2.series[i].name = json[((json[0]['num_sensors'])-(2-i))]['name'];
					options_2.series[i].data = json[((json[0]['num_sensors'])-(2-i))]['data'];
				}
/*				
				options_2.series[0].name = json[4]['name'];
				options_2.series[0].data = json[4]['data'];
				options_2.series[1].name = json[5]['name'];
				options_2.series[1].data = json[5]['data'];
*/
				chart = new Highcharts.Chart(options_2);			
			});
	      }
	    });
  	});
	
/////////////////////////////////////////////////
var options_room_all;
//<![CDATA[
//$(function () {
//    Highcharts.chart('container_room', {
$(document).ready(function() {
	    options_room_all = {	
				chart: {
					renderTo: 'container_room_all',
					type: 'line'
				},
				title: {
					text: ''
				},
				subtitle: {
					text: ''
				},
				xAxis: {
					type: 'datetime',
					dateTimeLabelFormats: {
					   day: '%d %b %Y'    //ex- 01 Jan 2016
					},
					title: {
						text: 'Date'
					}
				},
				yAxis: [{
					title: {
						text: 'Temperature (°C)'
					},
						min: 10,
						max: 60
					},
					{
					title: {
						text: 'ON/OFF Status'
					},
						min: 10,
						max: 60,
					gridLineWidth: 0,
					opposite: true
//					opposite: false
				}],

				tooltip: {
					headerFormat: '<b>{series.name}</b><br>',
//					pointFormat: '{point.x:%e. %b}: {point.y:.2f} °C'
					pointFormat: '({point.x:%d %b %H:%M:%S})-> {point.y:.2f} °C'
				},

				plotOptions: {
					line: {
						marker: {
							enabled: false
						}
					}
				},
				series: [{
						type : 'line',
						data: []
					},
					{
						data: [],
						type : 'line',
						yAxis: 1
					},
					{
						data: [],
						type : 'line',
						yAxis: 1
					},
					{
						data: [],
						type : 'line',
						yAxis: 1
					},
					{
						data: [],
						type : 'line',
						yAxis: 1
					},
					{
						data: [],
						type : 'line',
						yAxis: 1
					},
					{
						data: [],
						type : 'line',
						yAxis: 1
					},
					{
						data: [],
						type : 'line',
						yAxis: 1
					},
					{
						data: [],
						type : 'line',
						yAxis: 1
					}]

		};			
			
			Highcharts.setOptions({
				global: {
					timezoneOffset: -8.5 * 60
				}
			});
	
			$.getJSON("./data_4_room.php", function iroom_all (json) {
				options_room_all.series[0].name = json[1]['name'];		//room-1 
				options_room_all.series[0].data = json[1]['data'];
				options_room_all.series[1].name = json[3]['name'];		//room-2
				options_room_all.series[1].data = json[3]['data'];
				options_room_all.series[2].name = json[5]['name'];
				options_room_all.series[2].data = json[5]['data'];
				options_room_all.series[3].name = json[7]['name'];
				options_room_all.series[3].data = json[7]['data'];
				options_room_all.series[4].name = json[9]['name'];
				options_room_all.series[4].data = json[9]['data'];
				options_room_all.series[5].name = json[11]['name'];
				options_room_all.series[5].data = json[11]['data'];
				options_room_all.series[6].name = json[13]['name'];
				options_room_all.series[6].data = json[13]['data'];
				options_room_all.series[7].name = json[15]['name'];
				options_room_all.series[7].data = json[15]['data'];
				options_room_all.series[8].name = json[16]['name'];		//input temperature
				options_room_all.series[8].data = json[16]['data'];

				chart = new Highcharts.Chart(options_room_all);			
			});


});
//]]> 
    $(function() {
	    $( "#datepicker_3" ).datepicker({
		  dateFormat: "yy-mm-dd",
	      showOn: "button",
	      buttonImage: "calendar.gif",
	      buttonImageOnly: true,
	      onSelect: function(dateText, inst) { 
		  
	        $.getJSON("./data_4_room.php?dateParam="+dateText, function(json){
				options_room_all.series[0].name = json[1]['name'];		//room-1 
				options_room_all.series[0].data = json[1]['data'];
				options_room_all.series[1].name = json[3]['name'];		//room-2
				options_room_all.series[1].data = json[3]['data'];
				options_room_all.series[2].name = json[5]['name'];
				options_room_all.series[2].data = json[5]['data'];
				options_room_all.series[3].name = json[7]['name'];
				options_room_all.series[3].data = json[7]['data'];
				options_room_all.series[4].name = json[9]['name'];
				options_room_all.series[4].data = json[9]['data'];
				options_room_all.series[5].name = json[11]['name'];
				options_room_all.series[5].data = json[11]['data'];
				options_room_all.series[6].name = json[13]['name'];
				options_room_all.series[6].data = json[13]['data'];
				options_room_all.series[7].name = json[15]['name'];
				options_room_all.series[7].data = json[15]['data'];
				options_room_all.series[8].name = json[16]['name'];		//input temperature
				options_room_all.series[8].data = json[16]['data'];
				
				chart = new Highcharts.Chart(options_room_all);			
			});
	      }
	    });
  	});


