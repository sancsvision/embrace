$(document).ready(function(){
	getDeviceList();
});


function addDevice(){
	var obj = new Object();
	obj.i = $('#i').val();
	obj.c = $('#c').val();
	obj.t = $('#t').val();
	$.ajax({
		url:'/iLocate/admin/ajax/device_add.php',
		data: obj,
		type:'POST',
		async:false,
		success:function(data){
			var data = JSON.parse(data);
			if(data.status == 'success' ){
				getDeviceList();
			}	
		}
	});
}
function getDeviceList(){
	var htm = '';
		htm +=	'<table class="table table-striped table-bordered bootstrap-datatable datatable">';
		htm +=	'<thead>';
		htm +=	'   <tr>';
		htm +=	'	  <th>Device UDID</th>';
		htm +=	'	  <th>Contact</th>';
		htm +=	'	  <th>Type</th>';
		htm +=	'	  <th>Date</th>';
	/*	htm +=	'	  <th>Actions</th>'; */
		htm +=	'   </tr>';
		htm +=	'</thead>'; 
		htm +=	'</tbody>'; 		
	$.ajax({
		url:'ajax/device_list.php',
		async:false,
		success:function(data){
			var data = JSON.parse(data);
			if(data.status == 'success' ){
				$.each(data.l, function(k,v){
					htm +=	'<tr>';
					htm +=	'<td>'+v.i+'</td>';
					htm +=	'<td>'+v.c+'</td>';
					htm +=	'<td>'+v.t+'</td>';
					htm +=	'<td>'+v.d+'</td>';
			/*		htm +=	'<td class="center">';
					htm +=	'	<a class="btn btn-success" href="#">';
					htm +=	'		<i class="icon-zoom-in icon-white"></i>';
					htm +=	'		View';                                            
					htm +=	'	</a>';
					htm +=	'	<a class="btn btn-info" href="#">';
					htm +=	'		<i class="icon-edit icon-white"></i>';  
					htm +=	'		Edit';                                            
					htm +=	'	</a>';
					htm +=	'	<a class="btn btn-danger" href="#">';
					htm +=	'		<i class="icon-trash icon-white"></i>'; 
					htm +=	'		Delete';
					htm +=	'	</a>';
					htm +=	'</td>';
			*/		
					htm +=	'</tr>';
				});
			}	
		}
	});
		htm +=	'</tbody>';
		htm +=	'</table>';
	$('#devices').html(htm);
}