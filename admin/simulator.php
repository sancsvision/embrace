<?php include($path.'header.php');
      include('include/verifyUser.php'); ?>

			<div>
				<ul class="breadcrumb">
					<li>
						<a href="index.php">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="pairing.php">Simulator</a>
					</li>
				</ul>
			</div>
			
			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> Simulator</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div id="pairing" class="box-content">
						<table id="device-table" class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>Parent </th>
								  <th>Child </th>
								  <th>Child Name</th>
								  <th>Image</th>
								  <th>Contact</th>
								  <th>Date</th>
								<!--  <th>Actions</th> -->
							  </tr>
						  </thead>   
						  <tbody>
						  </tbody>
					  </table>            
					</div>
				</div><!--/span-->			
			</div><!--/row-->
			</div><!--/row-->
	
<?php include('footer.php'); ?>
<script src="<?php echo $path ; ?>js/admin_simulator.js"></script>	

