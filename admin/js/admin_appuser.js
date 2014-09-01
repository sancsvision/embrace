$(document).ready(function(){
	getAppUserList();
	$('#appuser-table').dataTable();
});
function getAppUserList(){
	var htm = '';
		htm +=	'<table id="appuser-table" class="table table-striped table-bordered bootstrap-datatable datatable">';
		htm +=	'<thead>';
		htm +=	'   <tr>';
		htm +=	'	  <th>Id</th>';
		htm +=	'	  <th>Contact No.</th>';
		htm +=	'	  <th>Status</th>';
		htm +=	'	  <th>Date</th>';
		htm +=	'	  <th>Actions</th>';		
		htm +=	'   </tr>';
		htm +=	'</thead>'; 
		htm +=	'<tbody>'; 		
	$.ajax({
		url:'ajax/appuser_list.php',
		async:false,
		success:function(data){
			var data = JSON.parse(data);
			if(data.status == 'success' ){
				$.each(data.data, function(k,v){
					htm +=	'<tr id="appuser_'+v.id+'" >';
					htm +=	'<td>'+v.i+'</td>';
					htm +=	'<td>'+v.c+'</td>';
					htm +=	'<td>'+v.s+'</td>';
					htm +=	'<td>'+v.d+'</td>';
					htm +=	'<td>';
						htm +=	'<a onclick="view('+v.id+');" title="View"  class="btn btn-success" href="#"><i class="icon-zoom-in icon-white" ></i></a>';
						htm +=	'<a onclick="edit('+v.id+');" title="Edit"  class="btn btn-info" href="#"><i class="icon-edit icon-white"></i> </a>';
						htm +=	'<a onclick="deleteAppuser('+v.id+');" title="Delete" class="btn btn-danger" href="#"><i class="icon-trash icon-white"></i></a>';
					htm +=	'</td>';
					htm +=	'</tr>';
				});
			}	
		}
	});
		htm +=	'</tbody>';
		htm +=	'</table>';
	$('#appuser').html(htm);
}	

function view(id){
	var htm = '';
	var obj = new Object();
	obj.id = id;
	$.ajax({
		url:'ajax/appuser_view.php',
		data: obj,
		type:'POST',
		async:false,
		success:function(data){
			var data = JSON.parse(data);
			if(data.status == 'success' ){
				htm +=	'<table class="table table-striped table-bordered bootstrap-datatable datatable">';
				htm +=	'<thead>';
				htm +=	'   <tr>';
				htm +=	'	  <th>Id</th>';
				htm +=	'	  <th>Name</th>';
				htm +=	'	  <th>Image</th>';
				htm +=	'	  <th>Contact</th>';		
				htm +=	'   </tr>';
				htm +=	'</thead>'; 
				htm +=	'<tbody>'; 
				$.each(data.l, function(k,v){
					htm +=	'<tr>';
					htm +=	'<td>'+v.i+'</td>';
					htm +=	'<td>'+v.n+'</td>';
					htm +=	'<td>'+v.im+'</td>';
					htm +=	'<td>'+v.c+'</td>';
					htm +=	'</tr>';
				});
				htm +=	'</tbody>';
				htm +=	'</table>';
				$('#viewappuser').html(htm);
			}
		}
	});
}

function edit(id){
	var htm = '';
	var obj = new Object();
	obj.id = id;
	$.ajax({
		url:'ajax/appuser_edit.php',
		data: obj,
		type:'POST',
		async:false,
		success:function(data){
			var data = JSON.parse(data);
			if(data.status == 'success' ){
				htm +=	'<form class="form-horizontal">';
				htm +=		'<fieldset>';
				
				htm +=		'<div class="control-group">';
				htm +=			'<label class="control-label" for="focusedInput">Contact No</label>';
				htm +=			'<div class="controls">';
				htm +=				'<input class="input-xlarge focused" id="contact" type="text" value="'+data.l.contact_no+'">';
				htm +=			'</div>';
				htm +=		'</div>';
				var status = (data.l.status == '1') ? 'Active' : 'Inactive' ;
				htm +=		'<div class="control-group">';
				htm +=			'<label class="control-label" for="focusedInput">Status</label>';
				htm +=			'<div class="controls">';
				htm +=				'<input class="input-xlarge focused typeahead" id="status" type="text" data-provide="typeahead" data-items="2" data-source="[\""Active"\", \""Inactive"\" ]" value="'+status+'">';
				htm +=			'</div>';
				htm +=		'</div>';

				htm +=		'<div class="form-actions">';
				htm +=			'<button onClick="updateAppuser('+id+');" type="button" class="btn btn-primary">Save changes</button>';
				htm +=			'<button onClick="edit('+id+');" class="btn">Cancel</button>';
				htm +=		'</div>';
							  
				htm +=		'<fieldset>';
				htm +=	'<form class="form-horizontal">';	
				
							  
							  /*<div class="control-group">
							  <label class="control-label" for="typeahead">Type </label>
							  <div class="controls">
								<input type="text" class="span6 typeahead" id="t"  data-provide="typeahead" data-items="4" data-source='["Bracelet", "Locket", "Chain", "Watch", "Toy", "Barbie"]'>
							  </div>
							</div>*/			  
							 
				$('#viewappuser').html(htm);
			}
		}
	});
}

function deleteAppuser(id){
		var obj = new Object();
		obj.id = id;
		$.ajax({
			url:'ajax/appuser_delete.php',
			data: obj,
			type:'POST',
			async:false,
			success:function(data){
				getAppUserList();
			}
		});

}
function updateAppuser(id){
		var obj = new Object();
		obj.id = id;
		obj.contact = $('#contact').val();
		obj.status  = $('#status').val();;
		$.ajax({
			url:'ajax/appuser_update.php',
			data: obj,
			type:'POST',
			async:false,
			success:function(data){
				getAppUserList();
			}
		});

}