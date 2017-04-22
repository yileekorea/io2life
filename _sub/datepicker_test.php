<!DOCTYPE html>

<HTML>
    <HEAD>
        <style type="text/css">
            body {
  			font-size: 10pt;
            }
        </style>
        		<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css">
		<script type="text/javascript" src="//code.jquery.com/jquery-1.9.1.js"></script>
		<script type="text/javascript" src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>        

        <script type="text/javascript"> 
            
            $(document).ready(function() {
				$("#txtDate").datepicker({
					showOn: 'button',
					buttonText: 'Show Date',
					buttonImageOnly: true,
					buttonImage: 'calendar.jpg',
					dateFormat: 'dd/mm/yy',
					constrainInput: true
				});
				
				$(".ui-datepicker-trigger").mouseover(function() {
					$(this).css('cursor', 'pointer');
				});
            
            });
            
        </script>
        
        
    </HEAD>
    <BODY>
        <input type='text' id='txtDate' />
        
    </BODY>
</HTML>