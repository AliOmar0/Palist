<!--
 <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
   integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
   crossorigin=""/>
 <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
   integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
   crossorigin=""></script>
-->

 <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
    <script src="https://unpkg.com/leaflet/dist/leaflet-src.js"></script>

<script src="https://unpkg.com/esri-leaflet"></script>
<link
      rel="stylesheet"
      href="https://unpkg.com/esri-leaflet-geocoder/dist/esri-leaflet-geocoder.css"
    />
    <script src="https://unpkg.com/esri-leaflet-geocoder"></script>

 
<div id="mapWrap" style="display:none;">
	<div class="map_box">
		<div class="map_btns">
			<div class="close_map po in" onClick="closeMap()"><?=l('Done<>تم')?></div>			
			<div class="delete_map_btn mid po" onclick="clearMarker()"><?=l('Delete Location<>حذف الموقع')?></div>
			<div class="mid" id="map_box_manual_box">
				<div id="map_box_manual_hit" class="mid"><?=l('You can pin on the map or enter coordinates manually<>تستطيع ان تضغط على الخارطة لتحديد الموقع، او كتابة الاحداثيات يدوياً')?></div>
				<input type="text" id="map_box_manual_input" class="mid" placeholder="<?=l('example<>مثال')?>: 31.8982,35.1967"/>
				<div class=" delete_map_btn mid po" onClick="manualMark()"><?=l('Mark<>علِّم')?></div>
			</div>
		</div>
		 <div id="mapPicker"></div>
	</div>    
</div>

 
<script>
	var map = L.map('mapPicker').setView([31.9073496,35.1883724], 8);

	
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

	var curr_map_field='';
	
  map.on('click',function(e){
    lat = e.latlng.lat;
    lon = e.latlng.lng;

      clearMarkers();

     window[curr_map_field+'_marker'] = L.marker([lat,lon],{icon: mapIcon}).addTo(map);
	  
	  point=lat+','+lon;
	  $('.'+curr_map_field+' input').val(point);
//	  p($('.'+curr_map_field+' input').val());
	  $('.'+curr_map_field+' .map_off').hide();
	  $('.'+curr_map_field+' .map_on').show();
	  $('.'+curr_map_field+' .map_btn').html(l('Change Location<>غيّر الموقع'));
	  
	  $('.'+curr_map_field+' .delete_map_btn').show();
	  
	  
});

	
	function clearMarker(field){
		
		if(field==undefined){
			field=curr_map_field;
	
		}
		window[field+'_marker']={};
		
	 $('.'+field+' input').val('');
//	p($('.'+field+' input').val());
	  $('.'+field+' .map_off').show();
	  $('.'+field+' .map_btn').html(l('Choose Location<>حدّد الموقع'));


	  $('.'+field+' .map_on').hide();
	  $('.'+field+' .delete_map_btn').hide();
		
		
		p('.'+field+' .map_on');
		//markers on map, not variables
		clearMarkers();
	}
	
	
	
	
function showMap(field){
	curr_map_field = field;
	clearMarkers();
//	p(window[curr_map_field+'_marker']);
	if(window[curr_map_field+'_marker']['_latlng']!=undefined){
		window[curr_map_field+'_marker'].addTo(map);
		map.flyTo(window[curr_map_field+'_marker']['_latlng'],14);
	}
	
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

	
	
	
	$(function(){
		//seek
		$('.location_field').each(function(){
			$(this).find('input').attr('type','hidden');
			$(this).append($('#map_wrap_sample').html());
			
			m=$(this).parent().attr('id');
			f=$(this).find('input').attr('name');
			$(this).find('.map_state').attr('onClick',"showMap('"+m+'_'+f+"')");
			$(this).find('.delete_map_btn').attr('onClick',"clearMarker('"+m+'_'+f+"')");
			window[m+'_'+f+'_marker']={};
			
			
			if($(this).find('input').val()!=undefined && $(this).find('input').val()!=''){
   			  pos=$(this).find('input').val().split(',');
			  window[m+'_'+f+'_marker'] = L.marker([pos[0],pos[1]],{icon: mapIcon});
			  $('.'+m+'_'+f+' .map_off').hide();
			  $('.'+m+'_'+f+' .map_on').show();
			  $('.'+m+'_'+f+' .map_btn').html(l('Change Location<>غيّر الموقع'));


			  $('.'+m+'_'+f+' .delete_map_btn').show();	
			}
			

			
		});
	});
	
	
	function manualMark(){
		newMark=$('#map_box_manual_input');
		newVal=$(newMark).val();
		$(newMark).val('');
		
		if(newVal!=''){
			clearMarkers();
			pos=newVal.split(',');
			lat=pos[0];
			lon=pos[1];
		  window[curr_map_field+'_marker'] = L.marker([lat,lon],{icon: mapIcon}).addTo(map);
		  $('.'+curr_map_field+' input').val(newVal);
		  $('.'+curr_map_field+' .map_off').hide();
		  $('.'+curr_map_field+' .map_on').show();
				  $('.'+curr_map_field+' .map_btn').html(l('Change Location<>غيّر الموقع'));

		  $('.'+curr_map_field+' .delete_map_btn').show();
		map.panTo(window[curr_map_field+'_marker']['_latlng']);

		}
	}
	
	
	
	//ersi arcgis
	 var searchControl = L.esri.Geocoding.geosearch({
        providers: [
          L.esri.Geocoding.arcgisOnlineProvider({
            // API Key to be passed to the ArcGIS Online Geocoding Service
            apikey: 'AAPK0a1d227275104633a35d9e90f2d1d4f61rmSBxM7pIWbpvZQshhb06uGBx8cTpcE8yJHE4_FXa2-grMyOSqZVMiYG2v94eZ8'
          })
        ]
      }).addTo(map);
	
	
	
//	// create an empty layer group to store the results and add it to the map
//      var results = L.layerGroup().addTo(map);
//
//      // listen for the results event and add every result to the map
//      searchControl.on("results", function (data) {
//        results.clearLayers();
//        for (var i = data.results.length - 1; i >= 0; i--) {
//          results.addLayer(L.marker(data.results[i].latlng));
//        }
//      });
	
	
</script>




<div id="map_wrap_sample" class="hidden">
	<div id="map_wrap">
		<div class="map_state mid po" onClick="">
			<i class="map_off mid">not_listed_location</i>
			<i class="map_on mid" style="display:none;">place</i>
			<div class="map_btn mid"><?=l('Choose location<>حدّد الموقع')?></div>
		</div>
		<div class="delete_map_btn mid po" style="display:none;" onClick="clearMarker()"><?=l('Delete Location<>حذف الموقع')?></div>
		
	</div>
</div>