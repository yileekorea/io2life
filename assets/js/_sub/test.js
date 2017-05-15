<div class="date-form">
    
<div class="form-horizontal">
    <div class="control-group">
        <label for="date-picker-1" class="control-label">A <i class="icon-calendar"> </i>

        </label>
        <div class="controls">
            <input id="date-picker-1" type="text" class="date-picker" />
        </div>
    </div>
    <div class="control-group">
        <label for="date-picker-2" class="control-label">B</label>
        <div class="controls">
            <div class="input-append">
                <input id="date-picker-2" type="text" class="date-picker" />
                <label for="date-picker-2" class="add-on"><i class="icon-calendar"></i>

                </label>
            </div>
        </div>
    </div>
    <div class="control-group">
        <label for="date-picker-3" class="control-label">C</label>
        <div class="controls">
            <div class="input-prepend">
                <label for="date-picker-3" class="add-on"><i class="icon-calendar"></i>

                </label>
                <input id="date-picker-3" type="text" class="date-picker" />
            </div>
        </div>
    </div>
</div>
    
    <hr />
<div>
    <span id="msg" class="controls uneditable-input"></span>
</div>
</div>







var date = new Date();
date.setDate(date.getDate());
   $('#datepicker').ready(function() {
		var datum = $('#datepicker').datepicker({ 

		//language: "cs-CZ", 
		//startDate: date,
		format: 'yyyy-mm-dd',
		todayHighlight: true 
	}) 
	.on('changeDate', function(ev) {
	  var datumy = $('#datepicker').val().replace(/\//g,'-');
	  alert(datumy);
		$(this).datepicker('hide');
/*
		$('#datumpick').slideUp(100);
		alert
		   $.ajax({
	   url: 'http://***********/******.php',
	   data: {druh: '30', vyberdatapicker: datumy},
	   type: "POST",
	   success: function(data){
				$('#result').html(data);   
	   }
	   */
   });

  });

});




$(function() {
    $('.date-pick').datePicker( {
        onSelect: function(date) {
            alert(date)
        },
        selectWeek: true,
        inline: true,
        startDate: '01/01/2000',
        firstDay: 1,
    });
});

<div class="date-form">
    
<div class="form-horizontal">
    <div class="control-group">
        <label for="date-picker-1" class="control-label">A <span class="glyphicon glyphicon-calendar"> </span>

        </label>
        <div class="controls">
            <input id="date-picker-1" type="text" class="date-picker form-control" />
        </div>
    </div>
    <div class="control-group">
        <label for="date-picker-2" class="control-label">B</label>
        <div class="controls">
            <div class="input-group">
                <input id="date-picker-2" type="text" class="date-picker form-control" />
                <label for="date-picker-2" class="input-group-addon btn"><span class="glyphicon glyphicon-calendar"></span>

                </label>
            </div>
        </div>
    </div>
    <div class="control-group">
        <label for="date-picker-3" class="control-label">C</label>
        <div class="controls">
            <div class="input-group">
                <label for="date-picker-3" class="input-group-addon btn"><span class="glyphicon glyphicon-calendar"></span>

                </label>
                <input id="date-picker-3" type="text" class="date-picker form-control" />
            </div>
        </div>
    </div>
</div>
    
    <hr />
<div>
    <span id="msg" class="controls form-control uneditable-input"></span>
</div>
</div>








