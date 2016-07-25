
jQuery.fn.exists = function(){return this.length>0;}

$('#collapseMap').on('shown.bs.collapse', function(e){

	(function(A) {

	if (!Array.prototype.forEach)
		A.forEach = A.forEach || function(action, that) {
			for (var i = 0, l = this.length; i < l; i++)
				if (i in this)
					action.call(that, this[i], i, this);
			};

		})(Array.prototype);

                var pinImgArr = ['American','Chinese','Fish','Mexican','Pizza','Hamburger','Sushi'];
                var markersData;
                
                var lanz=$("#cureentlang").val();
                var latz=$("#cureentlat").val();
                

                var mapOptions = {
				zoom: 13,
				center: new google.maps.LatLng(latz, lanz),
				mapTypeId: google.maps.MapTypeId.ROADMAP,

				mapTypeControl: false,
				mapTypeControlOptions: {
					style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
					position: google.maps.ControlPosition.LEFT_CENTER
				},
				panControl: false,
				panControlOptions: {
					position: google.maps.ControlPosition.TOP_RIGHT
				},
				zoomControl: true,
				zoomControlOptions: {
					style: google.maps.ZoomControlStyle.LARGE,
					position: google.maps.ControlPosition.TOP_RIGHT
				},
				scrollwheel: false,
				scaleControl: false,
				scaleControlOptions: {
					position: google.maps.ControlPosition.TOP_LEFT
				},
				streetViewControl: true,
				streetViewControlOptions: {
					position: google.maps.ControlPosition.LEFT_TOP
				},
				styles: 
				[{"featureType":"landscape","stylers":[{"hue":"#FFBB00"},{"saturation":43.400000000000006},{"lightness":37.599999999999994},{"gamma":1}]},{"featureType":"road.highway","stylers":[{"hue":"#FFC200"},{"saturation":-61.8},{"lightness":45.599999999999994},{"gamma":1}]},{"featureType":"road.arterial","stylers":[{"hue":"#FF0300"},{"saturation":-100},{"lightness":51.19999999999999},{"gamma":1}]},{"featureType":"road.local","stylers":[{"hue":"#FF0300"},{"saturation":-100},{"lightness":52},{"gamma":1}]},{"featureType":"water","stylers":[{"hue":"#0078FF"},{"saturation":-13.200000000000003},{"lightness":2.4000000000000057},{"gamma":1}]},{"featureType":"poi","stylers":[{"hue":"#00FF6A"},{"saturation":-1.0989010989011234},{"lightness":11.200000000000017},{"gamma":1}]}]

			};
                var mid = "";        
                if ( $("#merchant_id_map").exists() ){
		
                  mid=  $("#merchant_id_map").val();
	        }
                var
                marker;
		var
		mapObject,tempData =[],index=0;
		markers = [],
                params="action=getRestaurentByMap&currentController=store&merchant_id_map="+mid;
                mapObject = new google.maps.Map(document.getElementById('map'), mapOptions);
                
                busy(true);
                $.ajax({    
                type: "POST",
                url: ajax_url,
                data: params,
                dataType: 'json',       
                success: function(data){ 
                    busy(false);      
                    if (data.code==1){   
                        
                         for (var key in data.details){
                             dump(pinImgArr[index]);
                        // console.log(index);
                        
                    	  data.details[key].forEach(function (item) {
        		    
                            	marker = new google.maps.Marker({
                                    position: new google.maps.LatLng(item.location_latitude, item.location_longitude),
                                    map: mapObject,
                                    icon: sites_url+'/assets/front/img/pins/' + pinImgArr[index] + '.png',
				});
 
                                if ('undefined' === typeof markers[key])
                                    markers[key] = [];
                                    markers[key].push(marker);
                                    google.maps.event.addListener(marker, 'click', (function () {
                                    closeInfoBox();
                                    getInfoBox(item).open(mapObject, this);
                                    mapObject.setCenter(new google.maps.LatLng(item.location_latitude, item.location_longitude));
                               }));
                             
        		  });
                         index++;
                         if(index >= 6){
                            index = 0;
                         }
                      }
                   
                    }
                }, 
                error: function(){	        	    	
                    busy(false); 
                }		
                });
                
	
		function hideAllMarkers () {
			for (var key in markers)
				markers[key].forEach(function (marker) {
					marker.setMap(null);
				});
		};

		function closeInfoBox() {
			$('div.infoBox').remove();
		};

		function getInfoBox(item) {
			return new InfoBox({
				content:
				'<div class="marker_info" id="marker_info">' +
				'<img width="150" src="' + item.map_image_url + '" alt=""/>' +
				'<h3>'+ item.name_point +'</h3>' +
				'<em>'+ item.type_point +'</em>' +
				'<span>'+ item.description_point +'</span>' +
				
				'</div>',
				disableAutoPan: true,
				maxWidth: 0,
				pixelOffset: new google.maps.Size(35, -170),
				closeBoxMargin: '5px -20px 2px 2px',
				closeBoxURL: "http://www.google.com/intl/en_us/mapfiles/close.gif",
				isHidden: false,
				pane: 'floatPane',
				enableEventPropagation: true
			});


		};

    });