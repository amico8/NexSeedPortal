<script type="text/javascript">
		google.maps.event.addDomListener(window, 'load', function()
		{
			// La Guardia Flats2の経緯度
			var lng = <?php echo $_POST['lng']; ?>;
			var lat = <?php echo $_POST['lat']; ?>;
			var latlng = new google.maps.LatLng(lat, lng);
			var mapOptions = {
				zoom: 15,
				center: latlng,
				mapTypeId: google.maps.MapTypeId.ROADMAP,
				scaleControl: true
			};
			// マップを表示する
			var mapObj = new google.maps.Map(document.getElementById('gmap'), mapOptions);
			// マップ上にマーカーを表示する
			var markerObj = new google.maps.Marker({
				position: latlng,
				map: mapObj
			});
		});
	</script>
