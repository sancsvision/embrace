<?php 
// AIzaSyCqC93j_6firYua5ilGbhEWi8UdJWS5y6w
if(isset($_GET['id']) && $_GET['id'] != ''){
$pairing_id = $_GET['id'];
}else{
$pairing_id = 0;
}
include($path.'header.php');
      include('include/verifyUser.php'); ?>

			<div>
				<ul class="breadcrumb">
					<li>
						<a href="index.php">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="pairing.php">Fence</a>
					</li>
				</ul>
			</div>
			<div class="row-fluid sortable">		
				<div class="box span12" style="height:400px;" >
					<div class="box-header well" data-original-title>
						<h2><img id="child-img" src=""  height="25px" width="25px" style="border-radius:5px;" ></i>&nbsp;&nbsp;<span id="child-name"></span></h2>
						<div class="btn-group box-icon">
							<a  onClick="loadFence();" href="#" class="btn ">R</a>
							<a  onClick="power();" href="#" class="btn ">B</a>
							<a  onClick="warning();" href="#" class="btn ">W</a>							
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<input type="hidden" id="pairingId" value="<?php  echo $pairing_id; ?>" />
					<div id="fence" value="" style="visibility:hidden;" ></div>
					<div id="location" value="" style="visibility:hidden;" ></div>
					<div id="map-canvas" class="box-content">            
					</div>
				</div><!--/span-->			
			</div><!--/row-->
			</div><!--/row-->
    <style>
    #map-canvas {
        height: 100%;
	    width: 100%;	
        margin: 0px;
        padding: 0px
      }
    </style>
			
<?php include('footer.php'); ?>
    <script type="text/javascript"src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCqC93j_6firYua5ilGbhEWi8UdJWS5y6w&sensor=false"></script>
<script>
function power(){
	var pairingId = $('#pairingId').val();
	$.ajax({
		url:'ajax/power.php?id='+pairingId,
		async:true,
		success:function(data){
		}
	});
}
function warning(){
	var pairingId = $('#pairingId').val();
	$.ajax({
		url:'ajax/warning.php?id='+pairingId,
		async:true,
		success:function(data){
		}
	});
}

function addLastLocation(lat_coord,long_coord){
	var pairingId = $('#pairingId').val();
	$.ajax({
		url:'ajax/addLastLocation.php?id='+pairingId+'&lat='+lat_coord+'&long='+long_coord,
		async:true,
		success:function(data){
		}
	});
}


function loadFence(){
	var pairingId = $('#pairingId').val();
	$.ajax({
		url:'ajax/loadFence.php?id='+pairingId,
		async:true,
		success:function(data){
			var j =JSON.parse(data);
			$('#child-name').html(j.n);
			$('#child-img').attr('src', 'http://www.embrace4u.com/embrace/apis/'+j.img);
			if(j.location == 'success'){
				var htm = '';
				$('#location').attr('value', j.location );
				$.each(j.locationlist, function(k,v){
					htm += '<span dt="'+v.date+'" lat="'+v.lat+'" long="'+v.long+'" ></span>';
					pos = new google.maps.LatLng(v.lat, v.long);
					if(k == 0){
						placeMarker(pos, map);	
					} 
				});
				$('#location').html(htm);
			}
			if(j.fence == 'success'){
				var htm = '';
				arrFence = new Array();
				$('#fence').attr('value', j.fence );
				$.each(j.fencelist, function(k,v){
					htm += '<span n="'+v.n+'" t="'+v.t+'" lat="'+v.lat+'" long="'+v.long+'" dist="'+v.dist+'" ></span>';
					varFence = new Array();
					varFence.dist = v.dist;
					varFence.position = new google.maps.LatLng(v.lat, v.long);
					varFence.color = arrColor[k];
					addFence(varFence);
				});
				$('#fence').html(htm);
			}
			//initialize();
			
		}
	});
}
var map;
var add;
var arrColor = ['#FF0000', '#FF6600', '#FFCC00', '#FF0033', '#FF0099', '#FF00DD', '#00FF33'];
function initialize() {
  var mapOptions = {
    zoom: 8,
    center: new google.maps.LatLng(36.73888412439431, -81.28711223602295)
  };
  map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
	  
loadFence();
/*
  var mapOptions = {
    zoom: 8,
    center: new google.maps.LatLng(36.73888412439431, -81.28711223602295)
  };
  map = new google.maps.Map(document.getElementById('map-canvas'),
      mapOptions);
*/	  
 google.maps.event.addListener(map, 'click', function(e) {
    placeMarker(e.latLng, map);
  });

}
function placeMarker(position, map) {
  marker = new google.maps.Marker({
    position: position,
    map: map
  });
  map.panTo(position);
  var lat_coord= position.lat();
  var long_coord= position.lng();
  addLastLocation(lat_coord,long_coord);
}

function addFence(varFence){
var fence = {
      strokeColor: varFence.color,
      strokeOpacity: 0.8,
      strokeWeight: 2,
      fillColor: varFence.color,
      fillOpacity: .35,
      map: map,
      center: varFence.position,
      radius: parseInt(varFence.dist),
	  draggable: false
    };
    // Add the circle for this city to the map.
    add = new google.maps.Circle(fence);
}
$(document).ready(function(){
	//loadFence();
});
google.maps.event.addDomListener(window, 'load', initialize);
</script>

