 <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
    <script src="https://unpkg.com/leaflet/dist/leaflet-src.js"></script>


<div id="mapWrap" style="display:none;">
	<div class="map_box">
		<div class="map_btns"> 
			<div class="close_map po in" onClick="closeMap()"><?=l('Done<>تم')?></div>			
		</div>
		 <div id="mapPicker"></div>
	</div>
</div>




<script>
	var map = L.map('mapPicker').setView([31.9073496,35.1883724], 14);
	
	L.tileLayer('https://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
		maxZoom: 20,
		subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
	}).addTo(map); 
	
	var mapIcon = L.icon({
    iconUrl: '<?=pres.'imgs/pin.png'?>',
    shadowUrl: '<?=pres.'imgs/shadow_pin.png'?>',
    iconSize:     [50, 92], // size of the icon
    shadowSize:   [97, 92], // size of the shadow
    iconAnchor:   [25, 92], // point of the icon which will correspond to marker's location
	});

	
function showMap(pos){
	pos=pos.split(',');
	lat=pos[0];
	lon=pos[1];
	clearMarkers();
	L.marker([lat,lon],{icon: mapIcon}).addTo(map);
	
	map.panTo([lat,lon]);
	
	$('#mapWrap').show(100,function(){
		map.invalidateSize(false);
	});
}
	
	function closeMap(){
		$('#mapWrap').hide(20);
	}
	
		function clearMarkers(){
		 map.eachLayer((layer) => {
		 if(layer['_latlng']!=undefined)
			 layer.remove();
	 });
	}

	
</script>