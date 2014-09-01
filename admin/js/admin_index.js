$(document).ready(function(){
	getDashboardCount();
});

function getDashboardCount(){
	$.ajax({
		url:'ajax/dashboard_count.php',
		success:function(data){
		var data = JSON.parse(data);
				$('#total_d').html(data.d);
				$('#total_a').html(data.a);
				$('#total_p').html(data.p);
				$('#total_f').html(data.f);
				
				$('#today_d').html(data.td);
				$('#today_a').html(data.ta);
				$('#today_p').html(data.tp);
				$('#today_f').html(data.tf);				
		}
	});
}	