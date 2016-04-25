<div class="col-md-3 m-t-lg">
              
<?php
if(!empty($left_category_menu)) {
	foreach($left_category_menu as $catKey=>$categoryMenu)
	{
	?>

	<div class="panel panel-white">
		<div class="panel-heading">
			<div class="panel-title" ><?php echo $categoryMenu[0]['category_name']?></div>
		</div>
		<div class="panel-body">
			
			<ul class="list-unstyled mailbox-nav">
			<?php
			foreach($categoryMenu as $innerCategory)
			{
				?>
				<li><a href="#"><p><?php echo $innerCategory['category_name'];?></p></a></li>
				<?php
			}
			?>
			
		  </ul>  
		</div>
	</div>	
	
	<?php
		
	}
?>
<?php
	
}else{
	
?>

<div class="panel panel-white">
<div class="panel-heading">
	<div class="panel-title" >No Category found</div>
</div>

</div>
<?php	
}
?>
</div>