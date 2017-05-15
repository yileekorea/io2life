
function getQuerystring(paramName){ 
	var _tempUrl = window.location.search.substring(1); //url에서 처음부터 '?'까지 삭제
	var _tempArray = _tempUrl.split('&'); 				// '&'을 기준으로 분리하기 

	for(var i = 0; _tempArray.length; i++) { 
		var _keyValuePair = _tempArray[i].split('='); 	// '=' 을 기준으로 분리하기 
		if(_keyValuePair[0] == paramName){ 				// _keyValuePair[0] : 파라미터 명 
			// _keyValuePair[1] : 파라미터 값 
			return _keyValuePair[1]; 
		} 
	} 
} 
				
	console.log(getQuerystring('roomParam')) // --> 'room number' 출력 
	roomText = getQuerystring('roomParam');
		
		
		
var chart; // global

/**
 * Request data from the server, add it to the graph and set a timeout to request again
 */
function requestData() {
	$.ajax({
		url: 'live-server-data_0.php?roomParam='+roomText, 
		success: function(point) {
			var series = chart.series[0],
				shift = series.data.length > 300; // shift if the series is longer than 30 = 1minute interval

			// add the point
			chart.series[0].addPoint(eval(point), true, shift);
			
			// call it again after one second
			setTimeout(requestData, 3000);	
		},
		cache: false
	});
}
	
$(document).ready(function() {
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container_real',
			defaultSeriesType: 'spline',
			events: {
				load: requestData
			}
		},
		title: {
			text: ''
		},
		xAxis: {
			type: 'datetime',
			tickPixelInterval: 150,
			maxZoom: 20 * 1000
		},
		yAxis: {
			minPadding: 0.2,
			maxPadding: 0.2,
			title: {
				text: 'Temperature (°C)',
				margin: 5
			},
			min: 10,
			max: 40,
		},
		series: [{
			name: '방 - '+roomText,
			data: []
		}],
		global: {
			//useUTC: true
			//timezoneOffset: -8.5 * 60
		}
		
	});		
});
