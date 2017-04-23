
function doit(m) {
	if (ws) { ws.send(m); }
}

/*
function data() {
  var r = "a,b\n2008-12-01,0.9\n2008-12-02,0.3\n2008-12-03,0.7\n"
  return r;
}

//g = new Dygraph(document.getElementById("demodiv"), data(), {
g = new Dygraph(document.getElementById("aeach_room_1"), "aeach_room_1.csv", {
   title: 'Example for changing x-axis label granularity 1',
   axes: {
    x: {
        pixelsPerLabel: 50
      }

    }    
});
*/

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
		
$(document).ready(function(){
        $.get("./adata_4_each_room.php?roomParam="+roomText, function(data){
			//g = new Dygraph(document.getElementById("aeach_room_1"), "aeach_room_1.csv", {
			g = new Dygraph(document.getElementById("aeach_room"), "aeach_room.csv", {
			   title: '하루 각방 온도와 난방 ON/OFF 상태',
				ylabel: 'Temperature (C)',
				legend: 'always',
				showRangeSelector: true,
				valueRange: [16, 36],
				labels: [ "Date", "Room_Temp", "ON/OFF"],
			   axes: {
				x: {
					pixelsPerLabel: 50
				  }
				}    
			});
            //alert("Data: " + roomText);
            //alert("Data: " + data);
        });
});

/*
    $(function() {
	    $( "#datepicker_room1" ).datepicker({
		  dateFormat: "yy-mm-dd",
	      showOn: "button",
	      buttonImage: "calendar.gif",
	      buttonImageOnly: true,
	      onSelect: function(dateText, inst) { 
		  
	        $.getJSON("./adata_4_each_room.php?dateParam="+dateText, function(json){

			
			});
	      }
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

		var text_1 = "./adata_4_each_room.php?dateParam=";
		var text_2 = datumy;
		var text_3 = "&roomParam=";
		var text_4 = roomText;
        $.get(text_1+text_2+text_3+text_4, function(data){
			g = new Dygraph(document.getElementById("aeach_room"), "aeach_room.csv", {
			   title: 'Daily Temperatures in Rooms vs ON/OFF',
				ylabel: 'Temperature (C)',
				legend: 'always',
				showRangeSelector: true,
				valueRange: [16, 36],
				labels: [ "Date", "Room_Temp", "ON/OFF"],
			   axes: {
				x: {
					pixelsPerLabel: 50
				  }
				}    
			});
            //alert("Data: " + roomText);
            //alert("Data: " + data);
		});

		
});

	
	
/*			
			
 $(document).ready(function () {
      new Dygraph(
			document.getElementById("aeach_room_01"), 
			"aeach_room_01.csv",
			//data(),
			{
//				title: 'Daily Temperatures in Rooms vs ON/OFF',
				ylabel: 'Temperature (C)',
				legend: 'always',
				showRangeSelector: true,
				valueRange: [16, 36],
				labels: [ "Date", "Room_Temp", "ON/OFF"]
			}
      );
      new Dygraph(
			document.getElementById("aeach_room_02"), 
			"aeach_room_02.csv",
			{
//				title: 'Daily Temperatures in Rooms vs ON/OFF',
				ylabel: 'Temperature (C)',
				legend: 'always',
				showRangeSelector: true,
				valueRange: [16, 36],
				labels: [ "Date", "Room_Temp", "ON/OFF"]
			}
        );
      new Dygraph(
			document.getElementById("aeach_room_03"), 
			"aeach_room_03.csv",
			{
//				title: 'Daily Temperatures in Rooms vs ON/OFF',
				ylabel: 'Temperature (C)',
				legend: 'always',
				showRangeSelector: true,
				valueRange: [16, 36],
				labels: [ "Date", "Room_Temp", "ON/OFF"]
			}
        );
      new Dygraph(
			document.getElementById("aeach_room_04"), 
			"aeach_room_04.csv",
			{
//				title: 'Daily Temperatures in Rooms vs ON/OFF',
				ylabel: 'Temperature (C)',
				legend: 'always',
				showRangeSelector: true,
				valueRange: [16, 36],
				labels: [ "Date", "Room_Temp", "ON/OFF"]
			}
        );
      new Dygraph(
			document.getElementById("aeach_room_05"), 
			"aeach_room_05.csv",
			{
//				title: 'Daily Temperatures in Rooms vs ON/OFF',
				ylabel: 'Temperature (C)',
				legend: 'always',
				showRangeSelector: true,
				valueRange: [16, 36],
				labels: [ "Date", "Room_Temp", "ON/OFF"]
			}
        );
      new Dygraph(
			document.getElementById("aeach_room_06"), 
			"aeach_room_06.csv",
			{
//				title: 'Daily Temperatures in Rooms vs ON/OFF',
				ylabel: 'Temperature (C)',
				legend: 'always',
				showRangeSelector: true,
				valueRange: [16, 36],
				labels: [ "Date", "Room_Temp", "ON/OFF"]
			}
        );
      new Dygraph(
			document.getElementById("aeach_room_07"), 
			"aeach_room_07.csv",
			{
//				title: 'Daily Temperatures in Rooms vs ON/OFF',
				ylabel: 'Temperature (C)',
				legend: 'always',
				showRangeSelector: true,
				valueRange: [16, 36],
				labels: [ "Date", "Room_Temp", "ON/OFF"]
			}
        );
		
      new Dygraph(
			document.getElementById("aeach_room_08"), 
			"aeach_room_08.csv",
			{
//				title: 'Daily Temperatures in Rooms vs ON/OFF',
				ylabel: 'Temperature (C)',
				legend: 'always',
				showRangeSelector: true,
				valueRange: [16, 36],
				labels: [ "Date", "Room_Temp", "ON/OFF"]
			}
        );
    }
);
*/