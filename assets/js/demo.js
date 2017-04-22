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
	};

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
	});


/*
var date = new Date();
date.setDate(date.getDate());
   $('#datepicker').ready(function() {
		var datum = $('#datepicker').datepicker({ 

		//language: "cs-CZ", 
		//startDate: date,
		format: 'yyyy-mm-dd',
		todayHighlight: true 
	}) 
	.on('changeDate', function() {
		var datumy = $('#datepicker').val().replace(/\//g,'-');
		alert(datumy);
		$(this).datepicker('hide');

		

		//$.getJSON('./data_4_n.php?dateParam='+dateText, function(data){
		$.getJSON('./data_4_n.php?dateParam='+datumy, function(data){
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

		
  });

});
*/


//working
$(".date-input").datepicker({
    // options
		format: 'yyyy-mm-dd',
		todayHighlight: true
});	


$(".date-input").on("changeDate", function(ev) {
    //var id = $(this).attr("id");
    //var val = $("label[for='" + id + "']").text();
    //$("#msg").text(val + " changed");
		var datumy = $('.date-input').val().replace(/\//g,'-');
		//var datumy = new Date(ev);
		$(this).datepicker('hide');
		alert(datumy);


		//$.getJSON('./data_4_n.php?dateParam='+dateText, function(data){
		$.getJSON('./data_4_n.php?dateParam='+datumy, function(data){
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

		
});


/*	
//$(".date-picker").datepicker();
$(".date-input").datepicker();

//$(".date-picker").on("change", function () {
$(".date-input").on("change", function(dateText, inst) {
    //var id = $(this).attr("id");
    //var val = $("label[for='" + id + "']").text();
    //$("#msg").text(val + " changed");
				alert(dateText);
	        $.getJSON('./data_4_n.php?dateParam='+dateText, function(data){
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

});
*/
	
/*
$(".date-input").datepicker({
		  autoclose: true,
	      onSelect: function(dateText, inst) {
			//alert(new Date(ev.date));
			alert(dateText);
		  	
	        $.getJSON('./data_4_n.php?dateParam='+dateText, function(data){
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
	      }

});	
*/
/*
//original
    $(function() {
	    $( '#in_datepicker' ).datepicker({
		  autoclose: true,
		  dateFormat: 'yy-mm-dd',
	      showOn: 'button',
	      buttonImage: 'calendar.gif',
	      buttonImageOnly: true,
	      onSelect: function(dateText, inst) {
			//alert(new Date(ev.date));
			alert(dateText);
		  	
	        $.getJSON('./data_4_n.php?dateParam='+dateText, function(data){
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
	      }
	    });
  	});
*/
/////////////////////////////////////////////////
var options_room_all,
	seriesOptions_3 = [];

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
				pointFormat: '({point.x:%b %d %H:%M:%S})-> {point.y:.2f} °C'
			},

			plotOptions: {
				line: {
					marker: {
						enabled: false
					}
				}
			},
			series: seriesOptions_3
	};			

/*
			Highcharts.setOptions({
				global: {
					timezoneOffset: -8.5 * 60
				}
			});
*/
		$.getJSON("./data_4_room.php", function(data) {
				for( i=0; i<((data[0]['num_sensors'])); i++) {
					seriesOptions_3[i] = {
										//yAxis: name,
										name: name,
										data: data
					};
					if(i+1 < (data[0]['num_sensors'])){
						seriesOptions_3[i].yAxis = 1;
					}
						seriesOptions_3[i].name = data[i]['name'];
						seriesOptions_3[i].data = data[i]['data'];
				}
				chart = new Highcharts.Chart(options_room_all);
			});

});

//working
$(".date-input2").datepicker({
    // options
		format: 'yyyy-mm-dd',
		todayHighlight: true
});	

$(".date-input2").on("changeDate", function(ev) {
    //var id = $(this).attr("id");
    //var val = $("label[for='" + id + "']").text();
    //$("#msg").text(val + " changed");
		var datumy = $('.date-input2').val().replace(/\//g,'-');
		//var datumy = new Date(ev);
		$(this).datepicker('hide');
		alert(datumy);


		//$.getJSON('./data_4_n.php?dateParam='+dateText, function(data){
				$.getJSON('./data_4_room.php?dateParam='+datumy, function(data){
					for( i=0; i<((data[0]['num_sensors'])); i++) {
						seriesOptions_3[i] = {
											//yAxis: name,
											name: name,
											data: data
						};
						if(i+1 < (data[0]['num_sensors'])){
							seriesOptions_3[i].yAxis = 1;
						}
							seriesOptions_3[i].name = data[i]['name'];
							seriesOptions_3[i].data = data[i]['data'];
					}
					chart = new Highcharts.Chart(options_room_all);
				});

		
});


/*
//original
    $(function() {
	    $( "#datepicker_3" ).datepicker({
			dateFormat: "yy-mm-dd",
			showOn: "button",
			buttonImage: "calendar.gif",
			buttonImageOnly: true,
			onSelect: function(dateText, inst) { 
				alert(dateText);
				$.getJSON('./data_4_room.php?dateParam='+dateText, function(data){
					for( i=0; i<((data[0]['num_sensors'])); i++) {
						seriesOptions_3[i] = {
											//yAxis: name,
											name: name,
											data: data
						};
						if(i+1 < (data[0]['num_sensors'])){
							seriesOptions_3[i].yAxis = 1;
						}
							seriesOptions_3[i].name = data[i]['name'];
							seriesOptions_3[i].data = data[i]['data'];
					}
					chart = new Highcharts.Chart(options_room_all);
				});
	      }
	    });
  	});
*/

