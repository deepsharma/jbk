<!DOCTYPE html>
<!--Head Part-->
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Dashboard - Leadmentor</title>

		<meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>	

		<!--basic styles-->

		<link href="<?php echo base_url()?>assets/css/bootstrap.min.css" rel="stylesheet" />
		<link href="<?php echo base_url()?>assets/css/bootstrap-responsive.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="<?php echo base_url()?>assets/css/font-awesome.min.css" />
		<link rel="stylesheet" href="<?php echo base_url()?>assets/css/style.css" />

		<!--[if IE 7]>
		  <link rel="stylesheet" href="<?php echo base_url()?>assets/css/font-awesome-ie7.min.css" />
		<![endif]-->

		<!--page specific plugin styles-->
		<link rel="stylesheet" href="<?php echo base_url()?>assets/css/jquery-ui-1.10.3.custom.min.css" />
		<link rel="stylesheet" href="<?php echo base_url()?>assets/css/chosen.css" />
		<link rel="stylesheet" href="<?php echo base_url()?>assets/css/datepicker.css" />
		<link rel="stylesheet" href="<?php echo base_url()?>assets/css/fullcalendar.css" />

		<!--fonts-->

		<link rel="stylesheet" href="<?php echo base_url()?>assets/css/ace-fonts.css" />

		<!--ace styles-->

		<link rel="stylesheet" href="<?php echo base_url()?>assets/css/ace.min.css" />
		<link rel="stylesheet" href="<?php echo base_url()?>assets/css/ace-responsive.min.css" />
		<link rel="stylesheet" href="<?php echo base_url()?>assets/css/ace-skins.min.css" />

		<!--[if lte IE 8]>
		  <link rel="stylesheet" href="<?php echo base_url()?>assets/css/ace-ie.min.css" />
		<![endif]-->

		<!--inline styles related to this page-->

		<!--ace settings handler-->

		<script src="<?php echo base_url()?>assets/js/ace-extra.min.js"></script>
		
		<script type="text/javascript">
		
		<!------------ table script ----------- -->
		$(function() {
			var oTable1 = $('#modal_table').dataTable( {
			"aoColumns": [
			{ "bSortable": false },
			{ "bSortable": false },
			{ "bSortable": false }
			] } );	
		})
  		<!-- ---------- KFC Edit script -------------- -->

		$(document).ready(function(){
			$('.res_edit').click(function(){
				$('#res_edit').show();
				//$('body').append('<div class="popup_Divbg"></div>'); commented by nitika
			});
	
			$('#res_close').click(function(){
			$('#res_edit').hide();
			$('.popup_Divbg').remove(); 
		});
		<!-------TO hide the pop up---->
			$(document).mouseup(function (e)
			{
				var container = $("#res_edit");
		
				if (!container.is(e.target) // if the target of the click isn't the container...
				&& container.has(e.target).length === 0) // ... nor a descendant of the container
				{
				container.hide();
				$('.popup_Divbg').remove();
				}
			}); 
		});

		</script>
	</head>
<!--Head part End-->