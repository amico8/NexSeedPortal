<div id="contact">
	<div class="contact fullscreen parallax">
		<div class="overlay02">
			<div class="container">
				<div class="row contact-row">
					<!-- /.contact form -->
					<div class="col-sm-7 contact-right">
						<form method="POST" id="contact-form" class="form-horizontal" action="" onSubmit="alert('Thank you for your feedback!');">
							<!-- カテゴリ -->
						<div class="btn-section dropdown01">
						 <select class="" name="Category">
							<option value="1">Category</option>
							<option value="2">レストラン</option>
							<option value="3">スーパー</option>
							<option value="4">商業施設</option>
							<option value="5">レジャー</option>
						</div>
						 </select>
							<!-- 店の名前 -->
						<div class="category">
							<input type="text" name="Store Name" placeholder="Store Name" class="form-control input-lg" value="">
						</div>
							<!-- 場所の写真 -->
						<!-- <div class="category">
							<input type="text" name="Location" placeholder="Location" class="form-control input-lg" value="">
							<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
    						<script type="text/javascript" src="js/jquery.js"></script>
   							<script type="text/javascript" src="js/map.js"></script>
   							<div id="map" class="map01"></div>
						</div> -->
						<!-- <div align="right" style="float: right">
							<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
    						<script type="text/javascript" src="js/jquery.js"></script>
   							<script type="text/javascript" src="js/map.js"></script>
   							<div id="map" style="width:200px; height:200px"></div>
   						</div> -->
   						 <meta http-equiv="content-type" content="text/html; charset=utf-8" />
					    <!-- googlemap API -->
					    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
					    <!-- googlemap API 実装 -->
					    <script type="text/javascript">
					        google.maps.event.addDomListener(window, 'load', function()
					        {
					            // La Guardia Flats2の経緯度
					            var lng = 123.90381932258606;
					            var lat = 10.329200473939935;
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

					            // クリック時のイベント
					            google.maps.event.addListener(mapObj, 'click', function(e)
					            {
					                // ポジションを変更
					                markerObj.position = e.latLng;
					                // マーカーをセット
					                markerObj.setMap(mapObj);
					                alert("経度:" + e.latLng.lat() + "  緯度:" + e.latLng.lng());
					            })
					        });
					    </script>
					    <div id="gmap" class="map01"style=""></div>

							<!-- 写真 -->
						<div class="category">
				           	<input type="file" name="Photo" placeholder="Photo" class="form-control input-lg" value="">
				        </div>
				          </form>
								<!-- 評価 -->
						<div class="abc">
                		<span>Review:</span>
                			<p class="abc01">
                   			<input type="radio" name="point" value="1">１
                    		<input type="radio" name="point" value="2">２
                    		<input type="radio" name="point" value="3" checked>３
                    		<input type="radio" name="point" value="4">４
                    		<input type="radio" name="point" value="5">５
                			</p>
              			</div>
						<!-- </tr> -->
							 <!-- コメント -->

						<div class="category">
              				<textarea name="comment" rows="5" cols="10" id="comment" class="form-control input-message wow fadeInUp"  placeholder="Comment" required></textarea>
              			</div>
							<!-- 戻るボタン -->
						<div class="col-sm-4 contact-right">
							<a href = "/NexSeedPortal/contents/index">
							<input type="submit" name="submit" value="Back"class="btn01 btn-success wow fadeInUp" />
						</div>
							<!-- 確認ボタン -->
						<div class="col-sm-4 contact-left">
							<a href = "/NexSeedPortal/contents/add_check">
							<input type="submit" name="submit" value="Post" class="btn btn-success wow fadeInUp" />
						</div>
						 </form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>