$(document).ready(function(){
	getPairingList();
	$('#pairing-table').dataTable();
});
function addDevice(){
	var obj = new Object();
	obj.i = $('#p').val();
	obj.c = $('#c').val();
	obj.t = $('#cn').val();
	obj.i = $('#i').val();
	obj.c = $('#ct').val();
	obj.t = $('#d').val();	
	$.ajax({
		url:'/iLocate/admin/ajax/pairing_add.php',
		data: obj,
		type:'POST',
		async:false,
		success:function(data){
			var data = JSON.parse(data);
			if(data.status == 'success' ){
				getPairingList();
			}	
		}
	});
}
function getPairingList(){
	var htm = '';
		htm +=	'<table id="pairing-table" class="table table-striped table-bordered bootstrap-datatable datatable">';
		htm +=	'<thead>';
		htm +=	'   <tr>';
		htm +=	'	  <th>Parent</th>';
		htm +=	'	  <th>Child</th>';
		htm +=	'	  <th>Child Name</th>';
		htm +=	'	  <th>Image</th>';
	 	htm +=	'	  <th>Contact</th>'; 
		htm +=	'	  <th>Date</th>'; 	
		htm +=	'   </tr>';
		htm +=	'</thead>'; 
		htm +=	'</tbody>'; 		
	$.ajax({
		url:'ajax/pairing_list.php',
		async:false,
		success:function(data){
			var data = JSON.parse(data);
			if(data.status == 'success' ){
				$.each(data.l, function(k,v){
					htm +=	'<tr>';
					htm +=	'<td><a href="fence.php?id='+v.id+'" target="_blank" >'+v.p+'</a></td>';
					htm +=	'<td>'+v.c+'</td>';
					htm +=	'<td>'+v.cn+'</td>';
					htm +=	'<td>'+v.i+'</td>';
					htm +=	'<td>'+v.ct+'</td>';
					htm +=	'<td>'+v.d+'</td>';
					htm +=	'</tr>';
				});
			}	
		}
	});
		htm +=	'</tbody>';
		htm +=	'</table>';
	$('#pairing').html(htm);
}	