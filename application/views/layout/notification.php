  
<?php 
$data['loggedUser']=$this->session->userdata('loggedIn');
$organizationId=$data['loggedUser']['organizationId'];
$userName=$data['loggedUser']['userName'];
$notifications= $this->pluginmodel->getNotificationAlert($organizationId);
$notification=json_encode($notifications);
?>

<div class="some" style="position: fixed; width: 325px; z-index: 9999999999; bottom: 0px; right: 0px; display: none;">
 
  <div class="widget-box light-border">
  
   <div class="widget-header header-color-dark">
    
    <h5 class="smaller"><i class="icon-phone"></i>Call back Notification </h5>
    <div class="widget-toolbar">
	<span class="badge badge-warning badge-right" id='notificationCount'>0</span>
    <button class="btn btn-mini btn-danger" id="notificationHide" onclick="hideNotification();"><i class="icon-remove"></i> Ok got it</button>
    </div>
   </div>
   <div class="widget-body" style="height: 233px;overflow-y: auto;" id="addNotification">
		
   </div>
   
   </div>
   </div>
 
<script>

function updateClock ( )
    {
	var base_url='<?=base_url();?>';
    var currentTime = new Date ( );
    var currentHours = currentTime.getHours ( );
    var currentMinutes = currentTime.getMinutes ( );
    var currentSeconds = currentTime.getSeconds ( );
    var currentMonth = currentTime.getMonth ( );
	var currentDate = currentTime.getDate( );
    var currentYear = currentTime.getFullYear( );
	
    currentMinutes = ( currentMinutes < 10 ? "0" : "" ) + currentMinutes;
	currentMonth =(currentMonth < 10 )? "0"+(currentMonth+1):(currentMonth+1);
	currentDate = ( currentDate < 10 ? "0" : "" ) + currentDate;
	currentSeconds = ( currentSeconds < 10 ? "0" : "" ) + currentSeconds;
	currentHours = ( currentHours < 10 ? "0" : "" ) + currentHours;
	var currentTimeString = currentYear+ "-"+currentMonth+ "-"+currentDate+ " " +currentHours + ":" + currentMinutes + ":" + currentSeconds;
    var NotificationData=eval('<?=$notification;?>');
	
	$.each( NotificationData, function( key, value ) 
	{
		//console.log(currentTimeString+value.callBackDate);
		if(currentTimeString==value.callBackDate)
		{
			
			$(".some").css("display", "block");
			$("#notificationName").text(''); 
			$("#notificationEmail").text(''); 
			$("#notificationMobile").text('');
			
			var appendData='<div class="widget-main padding-5"><div class="alert alert-info">Here is a callBack details for lead Please Make Call: <br><br><label class="dark">Name:</label> <span id="notificationName">'+value.name+'</span><label class="dark">Email:</label> <span id="notificationEmail">'+value.email+'</span><label class="dark">Mobile:</label> <span id="notificationMobile">'+value.phone+'</span></div></div>';
			$("#addNotification").append(appendData);
				var count=$("#notificationCount").html();
				count++;
			$("#notificationCount").html(count);
			$("#notificationName").text(value.name); 
			$("#notificationEmail").text(value.email); 
			$("#notificationMobile").text(value.phone);
			var dataString='name='+ value.name+'&Email='+ value.email+'&phone='+ value.phone+'&leadId='+ value.id;
			$.post(base_url+"plugins/sendNotification",dataString, function( data ) {
		
			});
			
		}
	});
	     
 }

$(document).ready(function()
{
   setInterval('updateClock()', 1000);

});

function hideNotification()
{
$(".some").css("display", "none");
}
</script>