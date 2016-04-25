<?php
$this->load->view('layout/notification');
?>
<div class="sidebar" id="sidebar">
				<script type="text/javascript">
					try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
				</script>

				<div class="sidebar-shortcuts" id="sidebar-shortcuts">
					<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">&nbsp;
						<!--<button class="btn btn-small btn-success">
							<i class="icon-signal"></i>
						</button>

						<button class="btn btn-small btn-info">
							<i class="icon-pencil"></i>
						</button>

						<button class="btn btn-small btn-warning">
							<i class="icon-group"></i>
						</button>

						<button class="btn btn-small btn-danger">
							<i class="icon-cogs"></i>
						</button>-->
					</div>

					<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
						<span class="btn btn-success"></span>

						<span class="btn btn-info"></span>

						<span class="btn btn-warning"></span>

						<span class="btn btn-danger"></span>
					</div>
				</div><!--#sidebar-shortcuts-->

				<ul class="nav nav-list">
		<?php 		
		//echo $this->config->item('admin');exit;
		if($this->config->item('TelecallerLevel')==$activeUserLevel) // for telecaller
		{ 
					?>
					<li class='<?php if(isset($active)&&$active == 'dashboard'){echo 'active'; }?>'>
					  <a href="<?php echo base_url();?>">
						<i class="icon-dashboard"></i>
						<span class="menu-text">Dashboard</span>
					  </a>
					</li>
					<li class='<?php if(isset($active)&&($active == 'allLeads'||$active == 'freshLead'||$active == 'importLead'||$active == 'invalidLead'||$active == 'attemptedLead')){echo 'active open'; }?>'>
					  <a href="#" class="dropdown-toggle" >
						<i class="icon-group"></i>
						<span class="menu-text">Leads</span>
						<b class="arrow icon-angle-down"></b>
					  </a>
					  <ul class="submenu">
						<li class='<?php if(isset($active)&&$active == 'freshLead'){echo 'active'; }?>'><a href="<?php echo base_url('freshLead')?>"><i class="icon-double-angle-right"></i> Fresh Leads</a></li>
						<li class='<?php if(isset($active)&&$active == 'attemptedLead'){echo 'active'; }?>'><a href="<?php echo base_url('attemptedLeads')?>"><i class="icon-double-angle-right"></i> Attempted Leads</a></li>
						<li class='<?php if(isset($active)&&$active == 'invalidLead'){echo 'active'; }?>'><a href="<?php echo base_url('invalidLead')?>"><i class="icon-double-angle-right"></i> Invalid Leads</a></li>
						<li class='<?php if(isset($active)&&$active == 'allLeads'){echo 'active'; }?>'><a href="<?php echo base_url('allLeads')?>"><i class="icon-double-angle-right"></i> All Leads<span class="badge badge-success"><?php printf($AllLeadsCountSidebar);?></span></a></li>
						<li class='<?php if(isset($active)&&$active == 'importLead'){echo 'active'; }?>'><a href="<?php echo base_url('importLead')?>"><i class="icon-double-angle-right"></i> Import Leads<span class="badge badge-important">new</span></a></li>
					  </ul>
					</li>
					<?php 
		}
			elseif($this->config->item('CounslorLevel')==$activeUserLevel)
			{
					?>
					
					<li class='<?php if(isset($active)&&$active == 'dashboard'){echo 'active'; }?>'>
					  <a href="<?php echo base_url();?>">
						<i class="icon-dashboard"></i>
						<span class="menu-text">Dashboard</span>
					  </a>
					</li>
					<li class='<?php if(isset($active)&&($active == 'allLeads'||$active == 'newLead'||$active == 'importLead'||$active == 'invalidLead'||$active == 'attemptedCounselor')){echo 'active open'; }?>'>
					  <a href="#" class="dropdown-toggle" >
						<i class="icon-group"></i>
						<span class="menu-text">Leads</span>
						<b class="arrow icon-angle-down"></b>
					  </a>
					  <ul class="submenu">
						<li class='<?php if(isset($active)&&$active == 'newLead'){echo 'active'; }?>'><a href="<?php echo base_url('newLead')?>"><i class="icon-double-angle-right"></i> New Leads</a></li>
						
						<li class='<?php if(isset($active)&&$active == 'attemptedCounselor'){echo 'active'; }?>'><a href="<?php echo base_url('attemptedCounselor')?>"><i class="icon-double-angle-right"></i> Attempted Leads</a></li>
						
						<li class='<?php if(isset($active)&&$active == 'invalidLead'){echo 'active'; }?>'><a href="<?php echo base_url('invalidLead')?>"><i class="icon-double-angle-right"></i> Invalid Leads</a></li>
						<li class='<?php if(isset($active)&&$active == 'allLeads'){echo 'active'; }?>'><a href="<?php echo base_url('allLeadsCounselor')?>"><i class="icon-double-angle-right"></i> All Leads<!--<span class="badge badge-success"><?php printf($AllLeadsCountSidebar);?></span>--></a></li>
						
						
						<li class='<?php if(isset($active)&&$active == 'importLead'){echo 'active'; }?>'><a href="<?php echo base_url('importLead')?>"><i class="icon-double-angle-right"></i> Import Leads<span class="badge badge-important">new</span></a></li>
					  </ul>
					</li>	
					<!-- --------------------- Interest Tracker----------------- -->
					<?php 
					
					$data['loggedUser']=$this->session->userdata('loggedIn');
					$organizationId=$data['loggedUser']['organizationId'];
					$userId=$data['loggedUser']['id'];
					$ispluginEnable= $this->pluginmodel->isInterestTrackerEnable($organizationId);
					if($ispluginEnable)
					{
					?>
					
					<li class='<?php if(isset($active)&&($active == 'freshInterestTrackerCounselor'||$active == 'sharedInterestTrackerCounselor'||$active == 'interestTracker')){echo 'active open'; }?>'>
					  
					  <a href="#" class="dropdown-toggle">
						<i class="icon-group"></i>
						<span class="menu-text">Interest Tracker</span>
						<b class="arrow icon-angle-down"></b>
					  </a>
					  <ul class="submenu">
												
						<li class='<?php if(isset($active)&&$active == 'freshInterestTrackerCounselor'){echo 'active'; }?>'>
							<a href="<?php echo base_url('freshInterestTrackerCounselor')?>">
							<i class="icon-double-angle-right"></i> Fresh</a>
						</li>
						<li class='<?php if(isset($active)&&$active == 'sharedInterestTrackerCounselor'){echo 'active'; }?>'>
							<a href="<?php echo base_url('sharedInterestTrackerCounselor')?>">
							<i class="icon-double-angle-right"></i> Shared</a>
						</li>
						<li class='<?php if(isset($active)&&$active == 'interestTracker'){echo 'active'; }?>'>
						<a href="<?php echo base_url('counselorInterestTracker')?>">
						<i class="icon-double-angle-right"></i>All</a>
						</li>
										
					  </ul>
					</li>
					<?php
					}
					?>
					<!-- --------------------- Interest Tracker----------------- -->
					
					<!-- Script added for Counselor (neha) -->
					<?php
					$data['loggedUser']=$this->session->userdata('loggedIn');
					$organizationId=$data['loggedUser']['organizationId'];
					$userId=$data['loggedUser']['id'];
					if($userId==117)
					{
					?>
					<!-- campaign setup-->					
						<?php 
						$isCampaignPluginEnable= $this->pluginmodel->isCampaignEnable($organizationId);
						if($isCampaignPluginEnable)
						{
						?>
							<li class='<?php if(isset($active)&&$active == 'campaign'){echo 'active open'; }?>'>					 
							<a href="#" class="dropdown-toggle">						
							<i class="icon-bar-chart"></i>						
							<span class="menu-text">Campaign</span>						
							<b class="arrow icon-angle-down"></b>					  
							</a>					  
							<ul class="submenu">						
							<li><a href="<?php echo base_url('campaign/campaignSetup')?>"><i class="icon-double-angle-right"></i> Campaign setup</a>
							</li>			  
							</ul>					
							</li>
						<?php
						}
						?>
											
					<!-- campaign setup-->
					<!-- sms plugin-->
					
					<li class='<?php if(isset($active)&&$active == 'smsTemplate'){echo 'active open'; }?>'>
					  <a href="#" class="dropdown-toggle">
						<i class="icon-mobile-phone"></i>
						<span class="menu-text">SMS</span>
						<b class="arrow icon-angle-down"></b>
					  </a>
					  <ul class="submenu">
						<li class='<?php if(isset($active)&&$active == 'smsTemplate'){echo 'active'; }?>'><a href="<?php echo base_url('sms/template')?>"><i class="icon-double-angle-right"></i> Templates</a></li>
					  </ul>
					</li>
					
					<!-- sms plugin-->
					<?php
					}
					?>
				<!-- Script added for Counselor (neha) -->
				</ul><!--/.nav-list-->
					
			<?php
			}
			else if($this->config->item('Admin')==$activeUserLevel)
			{
			?>
					
					<li class='<?php if(isset($active)&&$active == 'dashboard'){echo 'active'; }?>'>
					  <a href="<?php echo base_url();?>">
						<i class="icon-dashboard"></i>
						<span class="menu-text">Dashboard</span>
					  </a>
					</li>
					<li class='<?php if(isset($active)&&($active == 'allLeads'||$active == 'telecallerLead'||$active == 'counselorLead'||$active == 'importLead'||$active == 'invalidLead'||$active == 'attemptedLead')){echo 'active open'; }?>'>
					  <a href="#" class="dropdown-toggle" >
						<i class="icon-group"></i>
						<span class="menu-text">Leads</span>
						<b class="arrow icon-angle-down"></b>
					  </a>
					  <ul class="submenu">
						<li class='<?php if(isset($active)&&($active == 'telecallerLead'||$active == 'counselorLead')){echo 'active open'; }?>'>
							<a href="#" class="dropdown-toggle"><i class="icon-double-angle-right"></i> Fresh Leads</a>
							<ul class="submenu">
								<li class='<?php if(isset($active)&&$active == 'telecallerLead'){echo 'active'; }?>'><a href="<?php echo base_url('telecaller')?>"><i class="icon-double-angle-right"></i>Telecaller</a></li>
								<li class='<?php if(isset($active)&&$active == 'counselorLead'){echo 'active'; }?>'><a href="<?php echo base_url('counselor')?>"><i class="icon-double-angle-right"></i>Counselor</a></li>
							</ul>
						</li>
									
						
						<li class='<?php if(isset($active)&&$active == 'attemptedLead'){echo 'active'; }?>'><a href="<?php echo base_url('attemptedLeads')?>"><i class="icon-double-angle-right"></i> Attempted Leads</a></li>
						
						<li class='<?php if(isset($active)&&$active == 'invalidLead'){echo 'active'; }?>'><a href="<?php echo base_url('invalidLead')?>"><i class="icon-double-angle-right"></i> Invalid Leads</a></li>
						
						<li class='<?php if(isset($active)&&$active == 'allLeads'){echo 'active'; }?>'><a href="<?php echo base_url('allLeads')?>"><i class="icon-double-angle-right"></i> All Leads<span class="badge badge-success"><?php printf($AllLeadsCountSidebar);?></span></a></li>
						<li class='<?php if(isset($active)&&$active == 'importLead'){echo 'active'; }?>'><a href="<?php echo base_url('importLead')?>"><i class="icon-double-angle-right"></i> Import Leads<span class="badge badge-important">new</span></a></li>
					  </ul>
					</li>						
			<!-- --------------------- Interest Tracker----------------- -->
					<?php 
					
					$data['loggedUser']=$this->session->userdata('loggedIn');
					$organizationId=$data['loggedUser']['organizationId'];
					$userId=$data['loggedUser']['id'];
					$ispluginEnable= $this->pluginmodel->isInterestTrackerEnable($organizationId);
					if($ispluginEnable)
					{
					?>
					
					<li class='<?php if(isset($active)&&($active == 'freshInterestTracker'||$active == 'sharedInterestTracker'||$active == 'interestTracker')){echo 'active open'; }?>'>
					  
					  <a href="#" class="dropdown-toggle">
						<i class="icon-group"></i>
						<span class="menu-text">Interest Tracker</span>
						<b class="arrow icon-angle-down"></b>
					  </a>
					  <ul class="submenu">
												
						<li class='<?php if(isset($active)&&$active == 'freshInterestTracker'){echo 'active'; }?>'>
							
						<a href="<?php echo base_url('freshInterestTracker')?>" class="dropdown-toggle"><i class="icon-double-angle-right"></i> Fresh </a>
							
							
						<!--fresh active campaign -->
									<!-- --get all active campaing -->
									<ul class="submenu">
									<?php
									
									$bucketData=$this->campaignmodel->getAllActiveCampaignByOrgId($organizationId);
									foreach($bucketData as $bucket)
									{	
									?>
									<li class='<?php if(isset($active)&&$active == 'freshInterestTracker1'){echo 'active'; }?>'><a href="<?php echo base_url('freshInterestTrackerNotTransfered')."/".$bucket->campaign;?>"><i class="icon-double-angle-right"></i><?php echo $bucket->campaign;?><br/><span class="badge badge-important"><?php $getCampaignCount=$this->campaignmodel->getCountNotTransferedBucket($bucket->id,$organizationId); echo count($getCampaignCount);?></span></a>
									</li>
								
									<?php
									}
									?>
									
									<!-- --get all active campaing -->
									
									
						<!-- Fresh active campaign -->
						
						</ul>
						</li>
						<li class='<?php if(isset($active)&&$active == 'sharedInterestTracker'){echo 'active'; }?>'>
							<a href="<?php echo base_url('sharedInterestTracker')?>">
							<i class="icon-double-angle-right"></i> Shared</a>
						</li>
						<li class='<?php if(isset($active)&&$active == 'interestTracker'){echo 'active'; }?>'>
						<a href="<?php echo base_url('interestTracker')?>">
						<i class="icon-double-angle-right"></i>All</a>
						</li>
										
					  </ul>
					</li>
					<?php
					}
					?>
					<!-- --------------------- Interest Tracker----------------- -->
					
					<!-- campaign setup-->					
						<?php 
						$isCampaignPluginEnable= $this->pluginmodel->isCampaignEnable($organizationId);
						if($isCampaignPluginEnable)
						{
						?>
							<li class='<?php if(isset($active)&&$active == 'campaign'){echo 'active open'; }?>'>					 
							<a href="#" class="dropdown-toggle">						
							<i class="icon-bar-chart"></i>						
							<span class="menu-text">Campaign</span>						
							<b class="arrow icon-angle-down"></b>					  
							</a>					  
							<ul class="submenu">						
							<li><a href="<?php echo base_url('campaign/campaignSetup')?>"><i class="icon-double-angle-right"></i> Campaign setup</a>
							</li>			  
							</ul>					
							</li>
						<?php
						}
						?>
											
					<!-- campaign setup-->
					<li class='<?php if(isset($active)&&$active == 'manageUsers'){echo 'active open'; }?>'>
					  <a href="#" class="dropdown-toggle">
						<i class="icon-briefcase"></i>
						<span class="menu-text">Organisation Setup</span>
						<b class="arrow icon-angle-down"></b>
					  </a>
					  <ul class="submenu">
						<!--<li><a href="#"><i class="icon-double-angle-right"></i> Manage Branch</a></li>-->
						<li class='<?php if(isset($active)&&$active == 'manageUsers'){echo 'active'; }?>'><a href="<?php echo base_url('manageUsers');?>"><i class="icon-double-angle-right"></i> Manage Users</a></li>
					  </ul>
					</li>
					
					<li class='<?php if(isset($active)&&$active == 'status'){echo 'active open'; }?>'>
					  <a href="#" class="dropdown-toggle">
						<i class="icon-gears"></i>
						<span class="menu-text">System Setup</span>
						<b class="arrow icon-angle-down"></b>
					  </a>
					  <ul class="submenu">
						<li class='<?php if(isset($active)&&$active == 'status'){echo 'active'; }?>'><a href="<?php echo base_url('status')?>"><i class="icon-double-angle-right"></i> Status</a></li>
						
					  </ul>
					</li>
					<li class='<?php if(isset($active)&&$active == 'smsTemplate'){echo 'active open'; }?>'>
					  <a href="#" class="dropdown-toggle">
						<i class="icon-mobile-phone"></i>
						<span class="menu-text">SMS</span>
						<b class="arrow icon-angle-down"></b>
					  </a>
					  <ul class="submenu">
						<li class='<?php if(isset($active)&&$active == 'smsTemplate'){echo 'active'; }?>'><a href="<?php echo base_url('sms/template')?>"><i class="icon-double-angle-right"></i> Templates</a></li>
					  </ul>
					</li>
					
					<li class='<?php if(isset($active)&&$active == 'obdTemplate'){echo 'active open'; }?>'>
					  <a href="#" class="dropdown-toggle">
						<i class="icon-mobile-phone"></i>
						<span class="menu-text">OBD</span>
						<b class="arrow icon-angle-down"></b>
					  </a>
					  <ul class="submenu">
						<li class='<?php if(isset($active)&&$active == 'obdTemplate'){echo 'active'; }?>'><a href="<?php echo base_url('obd/template')?>"><i class="icon-double-angle-right"></i> Templates</a></li>
					  </ul>
					</li>
					
					<li class='<?php if(isset($active)&&$active == 'plugin'){echo 'active open'; }?>'>
					  <a href="#" class="dropdown-toggle">
						<i class="icon-key"></i>
						<span class="menu-text">Plug-in</span>
						<b class="arrow icon-angle-down"></b>
					  </a>
					  <ul class="submenu">
						<li class='<?php if(isset($active)&&$active == 'plugin'){echo 'active'; }?>'><a href="<?php echo base_url('plugins')?>"><i class="icon-double-angle-right"></i> All Plug-in
						<span class="badge badge-important">new</span>
						</a></li>
					  </ul>
					</li>
					
					<li class='<?php if(isset($active)&&$active == 'report'){echo 'active open'; }?>'>
					  <a href="#" class="dropdown-toggle">
						<i class="icon-info-sign"></i>
						<span class="menu-text">Report</span>
						<b class="arrow icon-angle-down"></b>
					  </a>
					  <ul class="submenu">
						<li class='<?php if(isset($active)&&$active == 'report'){echo 'active'; }?>'><a href="<?php echo base_url('report/reports')?>"><i class="icon-double-angle-right"></i> Report
						<span class="badge badge-important">new</span>
						</a></li>
					  </ul>
					</li>
					<!--<li>
					  <a href="#" class="dropdown-toggle">
						<i class="icon-bar-chart"></i>
						<span class="menu-text">Reports</span>
						<b class="arrow icon-angle-down"></b>
					  </a>
					  <ul class="submenu">
						<li><a href="#"><i class="icon-double-angle-right"></i> Campaign Reports</a></li>
						<li><a href="#"><i class="icon-double-angle-right"></i> System Reports</a></li>
					  </ul>
					</li>
					<li>
					  <a href="#">
						<i class="icon-cloud-download"></i>
						<span class="menu-text">Backup Data</span>
					  </a>
					</li>-->
				</ul><!--/.nav-list-->
					
					<?php
			}
			else
			{
					?>
					
					<li class="active">
					  <a href="<?php echo base_url();?>">
						<i class="icon-dashboard"></i>
						<span class="menu-text">Dashboard</span>
					  </a>
					</li>
					<li>
					  <a href="#" class="dropdown-toggle" >
						<i class="icon-group"></i>
						<span class="menu-text">Leads</span>
						<b class="arrow icon-angle-down"></b>
					  </a>
					  <ul class="submenu">
						<li><a href="newLeads.html"><i class="icon-double-angle-right"></i> New Leads</a></li>
						<li><a href="#"><i class="icon-double-angle-right"></i> Hot Leads</a></li>
						<li><a href="#"><i class="icon-double-angle-right"></i> Invalid Leads</a></li>
						<li><a href="<?php echo base_url('allLeads')?>"><i class="icon-double-angle-right"></i> All Leads</a></li>
						<li><a href="<?php echo base_url('importLead')?>"><i class="icon-double-angle-right"></i> Import Leads</a></li>
					  </ul>
					</li>
					<li>
					  <a href="#" class="dropdown-toggle">
						<i class="icon-briefcase"></i>
						<span class="menu-text">Organisation Setup</span>
						<b class="arrow icon-angle-down"></b>
					  </a>
					  <ul class="submenu">
						<li><a href="#"><i class="icon-double-angle-right"></i> Manage Branch</a></li>
						<li><a href="<?php echo base_url('manageUsers');?>"><i class="icon-double-angle-right"></i> Manage Users</a></li>
					  </ul>
					</li>
					<li>
					  <a href="#" class="dropdown-toggle" >
						<i class="icon-bullhorn"></i>
						<span class="menu-text">Campaign</span>
						<b class="arrow icon-angle-down"></b>
					  </a>
					  <ul class="submenu">
						<li><a href="#"><i class="icon-double-angle-right"></i> Create Campaign</a></li>
						<li><a href="#"><i class="icon-double-angle-right"></i> Manage Campaign</a></li>
					  </ul>
					</li>
					<li>
					  <a href="#" class="dropdown-toggle">
						<i class="icon-gears"></i>
						<span class="menu-text">System Setup</span>
						<b class="arrow icon-angle-down"></b>
					  </a>
					  <ul class="submenu">
						<li><a href="<?php echo base_url('status')?>"><i class="icon-double-angle-right"></i> Status</a></li>
						<li><a href="#"><i class="icon-double-angle-right"></i> Tags</a></li>
						<li><a href="#"><i class="icon-double-angle-right"></i> Universities</a></li>
						<li><a href="#"><i class="icon-double-angle-right"></i> Location</a></li>
					  </ul>
					</li>
					<li>
					  <a href="#" class="dropdown-toggle">
						<i class="icon-mobile-phone"></i>
						<span class="menu-text">SMS</span>
						<b class="arrow icon-angle-down"></b>
					  </a>
					  <ul class="submenu">
						<li><a href="<?php echo base_url('sms/alltemplate')?>"><i class="icon-double-angle-right"></i> All Templates</a></li>
						<li><a href="<?php echo base_url('sms/api')?>"><i class="icon-double-angle-right"></i> SMS Api<span class="badge badge-important">new</span></a></li>
					  </ul>
					</li>
					<li>
					  <a href="#" class="dropdown-toggle">
						<i class="icon-bar-chart"></i>
						<span class="menu-text">Dump</span>
						<b class="arrow icon-angle-down"></b>
					  </a>
					  <ul class="submenu">
						<li><a href="<?php echo base_url('report/downloadDump')?>"><i class="icon-double-angle-right"></i>Source Dump</a></li>
						<li><a href="<?php echo base_url('report/cityDump')?>"><i class="icon-double-angle-right"></i>City Dump</a></li>
						
						<!--<li><a href="#"><i class="icon-double-angle-right"></i> Campaign Reports</a></li>
						<li><a href="#"><i class="icon-double-angle-right"></i> System Reports</a></li>-->
					  </ul>
					</li>
					<li>
					  <a href="#" class="dropdown-toggle">
						<i class="icon-key"></i>
						<span class="menu-text">Plug-in</span>
						<b class="arrow icon-angle-down"></b>
					  </a>
					  <ul class="submenu">
						<li><a href="<?php echo base_url('plugins/all')?>"><i class="icon-double-angle-right"></i> All Plug-in
						<span class="badge badge-important">new</span>
						</a></li>
					  </ul>
					</li>
					<li>
					  <a href="#">
						<i class="icon-cloud-download"></i>
						<span class="menu-text">Backup Data</span>
					  </a>
					</li>
				</ul><!--/.nav-list-->
					
					<?php
			}
					?>
				<div class="sidebar-collapse" id="sidebar-collapse">
					<i class="icon-double-angle-left" data-icon1="icon-double-angle-left" data-icon2="icon-double-angle-right"></i>
				</div>

				<script type="text/javascript">
					try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
				</script>
			</div>