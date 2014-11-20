			<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
			<script>
			
				function initialize() {
					var mapOptions = {
						zoom: 16,
						center: new google.maps.LatLng(49.830054, 23.994006)
					}
					var map = new google.maps.Map(document.getElementById('map-canvas'),mapOptions);
					var image = '<?php bloginfo('template_directory'); ?>/images/mapa-marker.png';
					var myLatLng = new google.maps.LatLng(49.830054, 23.994006);
					var contentString = '<div id="mapa-content">'+
						  '<h2>Кабiнет копiрайтера М.Юрової</h2>'+
						  '<div id="mapa-content-data">'+
						  '<p>Адрес: <?php echo $options_theme['data_01']; ?></p>'+
						  '<p>Тел.: <?php echo $options_theme['data_02']; ?></p>'+
						  '<p>E-mail: <?php echo $options_theme['data_03']; ?></p>'+
						  '<p>Skype: <?php echo $options_theme['data_04']; ?></p>'+
						  '</div>'+
						  '</div>';
					var infowindow = new google.maps.InfoWindow({
						content: contentString
					});
					var marker = new google.maps.Marker({
						position: myLatLng,
						map: map,
						icon: image,
						title: 'Кабiнет копiрайтера М.Юрової'
					});
					google.maps.event.addListener(marker, 'click', function() {
						infowindow.open(map,marker);
					});
				}

				google.maps.event.addDomListener(window, 'load', initialize);

    </script>

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
case '01': $nm = 'Январь'; break;
case '02': $nm = 'Февраль'; break;
case '03': $nm = 'Март'; break;
case '04': $nm = 'Апрель'; break;
case '05': $nm = 'Май'; break;
case '06': $nm = 'Июнь'; break;
case '07': $nm = 'Июль'; break;
case '08': $nm = 'Август'; break;
case '09': $nm = 'Сентябрь'; break;
case '10': $nm = 'Октябрь'; break;
case '11': $nm = 'Ноябрь'; break;
case '12': $nm = 'Декабрь'; break;
	
	
	
case '01 ': $nm =' Січня '; break; 
case '02 ': $nm =' Лютого '; break; 
case '03 ': $nm =' Март '; break; 
case '04 ': $nm =' Апрель '; break; 
case '05 ': $nm =' Травня '; break; 
case '06 ': $nm =' Червня '; break; 
case '07 ': $nm =' Липня '; break; 
case '08 ': $nm =' Серпня '; break; 
case '09 ': $nm =' Вересня '; break; 
case '10 ': $nm =' Жовтень '; break; 
case '11 ': $nm =' Листопад '; break; 
case '12 ': $nm =' Грудня '; break;
	
	
	
	
	
	