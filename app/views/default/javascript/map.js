    var map;
    $(document).ready(function(){
      map = new GMaps({
		el: '#Gmap',
		lat: 6.2609198,
		lng: -75.5964927,
		zoom:15,
		panControl: false,
		scrollwheel: false,
		zoomControl: true,
		mapTypeControl:false,
		zoom_changed: function(e) {
			$("#zoom").val(e.zoom);
		}
      });
	  setTimeout( function(){
		  map.addMarker({
				  lat: 6.2609198,
				  lng: -75.5964927,
				  animation: google.maps.Animation.DROP,
				  draggable:true,
				icon: image,
				dragend: function(e) {
						getAddress(e.latLng.lat(),e.latLng.lng());
				},
				click: function(e) {
					console.log(e.position)
					getAddress(e.position.lat(),e.position.lng());
			 }
		  });
		  getAddress(6.2609198, -75.5964927);
	  },2000);
		
	//var siteURL=window.location.protocol + "//" + window.location.host + "/";
	var imgURL="assets/img/maker.png";
	var image = new google.maps.MarkerImage(imgURL,  new google.maps.Size(25,38), new google.maps.Point(0,0), new google.maps.Point(13,38) );
	map.setContextMenu({
	  control: 'map',
	  options: [{
		    title: '<i class="fa fa-map-marker"></i> &nbsp; Nueva Marca Aqui',
		    name: 'add_marker',
		    action: function(e) {
				this.addMarker({
						lat: e.latLng.lat(),
						lng: e.latLng.lng(),
						animation: google.maps.Animation.DROP,
						draggable: true,
						icon: image,
						dragend: function(e) {
								getAddress(e.latLng.lat(),e.latLng.lng());
						},
						click: function(e) {
							console.log(e.position)
							getAddress(e.position.lat(),e.position.lng());
					 }
				});
				getAddress(e.latLng.lat(),e.latLng.lng());
				
		    }
	  }]
	});
		
	 $(".getLocate").click(function(e){
			 GMaps.geolocate({
			   success: function(position){
				map.setCenter(position.coords.latitude, position.coords.longitude);
				map.addMarker({
					lat: position.coords.latitude,
					lng: position.coords.longitude,
					animation: google.maps.Animation.DROP,
					draggable: true,
					icon: image,
					dragend: function(e) {
						getAddress(e.latLng.lat(),e.latLng.lng());
 					 },
					 click: function(e) {
						getAddress(e.position.lat(),e.position.lng());
					 }
				});
				getAddress(position.coords.latitude,position.coords.longitude);
			   },
			   error: function(error){  alert('Geolocalización errada: '+error.message);   },
			   not_supported: function(){ alert("Tu navegador no soporta la Geolocalización"); }
			 });				  				  
	});

	 function getAddress(latitude,longitude){
				GMaps.geocode({
					address: latitude+","+longitude,
					callback: function(results, status){
						  if(status=='OK'){
							  var latlng = results[0].geometry.location;
							$("#addressPoint").val(results[0].formatted_address);
							$("#mapDetail p").html(results[0].formatted_address);
							$("#latLng").val(latlng.lat()+" , "+latlng.lng());
							$("#mapDetail small").html(latlng.lat()+" , "+latlng.lng());
						  }
					}
				});
	}
	
	 $(".staticMap").click(function(e){
			if($("#latLng").val()){
					var latlng=$("#latLng").val().split(",");
					staticMap(latlng[0],latlng[1]);
			}else{
					$.notific8('Por favor selecciona tu Geolocalización !! ',{ theme:"danger" ,heading:" ERROR :); "});
			}
	});

	function staticMap(latitude,longitude){
			url = GMaps.staticMapURL({
			  size: [ parseInt($("#mapWidth").val()), parseInt($("#mapHeigth").val()) ],
			  lat: latitude,
			  lng: longitude,
			  maptype: $("#mapType").val(),
			  zoom:parseInt($("#zoom").val()),
			  markers: [ {lat: latitude, lng: longitude,icon: imgURL} ]
			});
			$('#mapStatic img').attr('src', url);
			loading(1600);
			setTimeout(function () { $("#md-mapStatic").modal("show") }, 1500);
	}

	function loading(time){
		var overlay=$('<div class="load-overlay"><div><div class="c1"></div><div class="c2"></div><div class="c3"></div><div class="c4"></div></div><span>Loading...</span></div>');
		$("body").append(overlay);
		overlay.css('opacity',1).fadeIn("slow");
		if(time){
			setTimeout(function () {  
				$("body").find(overlay).fadeOut("slow",function(){ $(this).remove() });
			}, time);
		}
	}

	function unloading(){
		$("body").find(".load-overlay").fadeOut("slow",function(){ $(this).remove() });
	}

      $('#geocoding_form').submit(function(e){
        e.preventDefault();
        GMaps.geocode({
          address: $('#addressPoint').val().trim(),
          callback: function(results, status){
            if(status=='OK'){
              var latlng = results[0].geometry.location;
              map.setCenter(latlng.lat(), latlng.lng());
				map.addMarker({
					lat: latlng.lat(),
					lng: latlng.lng(),
					animation: google.maps.Animation.DROP,
					draggable: true,
					icon: image,
					dragend: function(e) {
						getAddress(e.latLng.lat(),e.latLng.lng());
 					 },
					 click: function(e) {
						getAddress(e.position.lat(),e.position.lng());
					 }
				});
				getAddress(latlng.lat(),latlng.lng());
            }
          }
        });
      });
	 
	$(".cp-slider-wrapper").each(function(i) {
		var slider=$(this), update=slider.find("input[type='hidden']"), data=slider.data();
		slider.modernSlider({
			total: data.max || 100,
			value:data.value,
			width: data.width || "100%",
			range: data.range,
			sliderOpened: data.opened,
			onChange: function(value) {
				map.setZoom(value);
			}
		});
		var sliderChange=slider.find("a.ui-slider-handle");
		sliderChange.css({ "background-color":$.fillColor(slider) });			
	});
	
	$("#mapType").change(function() {
		map.setStyle($(this).val());
	});
	

    });