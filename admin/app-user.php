<?php include($path.'header.php');
      include('include/verifyUser.php'); ?>

			<div>
				<ul class="breadcrumb">
					<li>
						<a href="index.php">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="pairing.php">App User</a>
					</li>
				</ul>
			</div>
			
			<div class="row-fluid sortable">		
				<div class="box span6">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> App User</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div id="appuser" class="box-content">
						<table id="appuser-table" class="table table-striped table-bordered bootstrap-datatable">
						  <thead>
							  <tr>
								  <th>Id</th>
								  <th>Contact No </th>
								  <th>Status</th>
								  <th>Date</th>
								  <th>Actions</th> 
							  </tr>
						  </thead>   
					  </table>            
					</div>
				</div><!--/span-->
				
				<div class="box span6">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> Edit App User</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div id="viewappuser" class="box-content">
						         
					</div>
				</div><!--/span-->	
				
			</div><!--/row-->
			</div><!--/row-->
	
<?php include('footer.php'); ?>
<script src="<?php echo $path ; ?>js/admin_appuser.js"></script>	

