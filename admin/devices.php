<?php include($path.'header.php');
      include('include/verifyUser.php'); ?>

			<div>
				<ul class="breadcrumb">
					<li>
						<a href="index.php">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="devices.php">Devices</a>
					</li>
				</ul>
			</div>
			
			<div class="row-fluid sortable">		
				<div class="box span6">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> Devices</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div id="devices" class="box-content">
						<table id="device-table" class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>Device UDID</th>
								  <th>Contact</th>
								  <th>Type</th>
								  <th>Date</th>
								<!--  <th>Actions</th> -->
							  </tr>
						  </thead>   
						  <tbody>
						  </tbody>
					  </table>            
					</div>
				</div><!--/span-->

				
				<div class="box span6">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i> Add New Device</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal">
							<fieldset>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Device UDID</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="i" type="text" value="">
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Contact</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="c" type="text" value="">
								</div>
							  </div>
							  <div class="control-group">
							  <label class="control-label" for="typeahead">Type </label>
							  <div class="controls">
								<input type="text" class="span6 typeahead" id="t"  data-provide="typeahead" data-items="4" data-source='["Bracelet", "Locket", "Chain", "Watch", "Toy", "Barbie"]'>
							  </div>
							</div>			  
							  <div class="control-group">
							    <label class="control-label" for="date01">Date</label>
							    <div class="controls">
								   <input type="text" class="input-xlarge disabled" disabled="" value="<?php echo date('d/m/Y'); ?>">
							     </div>
							</div>
							 
							  <div class="form-actions">
								<button onClick="addDevice();" type="button" class="btn btn-primary">Save changes</button>
								<button class="btn">Cancel</button>
							  </div>
							</fieldset>
						  </form>
					
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
			</div><!--/row-->
			
<?php include('footer.php'); ?>
<script src="<?php echo $path ; ?>js/admin_device.js"></script>		
