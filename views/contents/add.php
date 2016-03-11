<div id="contact">
	<div class="contact fullscreen parallax">
		<div class="overlay02">
			<div class="container">
				<div class="row contact-row">
					<!-- /.contact form -->
					<div class="col-sm-7 contact-right">
						<form method="post" id="contact-form" class="form-horizontal" action=""  enctype="multipart/form-data">
							<!-- カテゴリ -->
						<div class="btn-section dropdown01">
						 <select class="" name="Category">
							<option value="1">Category</option>
							<?php foreach ($this->categories as $category): ?>
                                    <?php if ($category['category_id'] == $this->viewOptions['category_id']):?>
                                        <option value="<?php echo $category['category_id'];?>" selected><?php echo $category['category_name']; ?></option>
                                    <?php else: ?>
                                        <option value="<?php echo $category['category_id'];?>"><?php echo $category['category_name']; ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
						</div>
						 </select>
							<!-- 店の名前 -->
						<div class="category">
							<input type="text" name="StoreName" placeholder="Store Name" class="form-control input-lg" value="" required>
							<?php if(isset($erorr['Store_Name']) && $erorr['Store_Name'] == 'blank'): ?>
			                <p class="post">* 名前を入れてください。</p>
			              <?php endif; ?>
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
				           	<input type="file" name="Photo" placeholder="Photo" class="form-control input-lg" value="" >
				           	 <?php if (isset($error['picture_path']) && $error['picture_path'] == 'type'): ?>
			                <p class="post">* 写真などは「.gif」「.jpg」の画像を指定してください。</p>
			              <?php endif; ?>
			              <?php if(!empty($post)): ?>
			                <p class="post">* 恐れ入りますが、画像を改めて指定してください。</p>
			              <?php endif; ?>
				        </div>
				          
								<!-- 評価 -->
						<div class="abc">
                		<span>Review:</span>
                			<p class="abc01">
                   			<label>1<input type="radio" name="point" value="1"></label>
                    		<label>2<input type="radio" name="point" value="2"></label>
                    		<label>3<input type="radio" name="point" value="3" checked></label>
                    		<label>4<input type="radio" name="point" value="4"></label>
                    		<label>5<input type="radio" name="point" value="5"></label>
                			</p>
              			</div>
						<!-- </tr> -->
							 <!-- コメント -->

						<div class="category">
              				<textarea name="comment" rows="5" cols="10" id="comment" class="form-control input-message fadeInUp"  placeholder="Comment" required></textarea>
              			</div>
							<!-- 戻るボタン -->
						<div class="col-sm-4 contact-right">
							<a href="/NexSeedPortal/contents/index/"><input type="button" name="bitton" value="Back"class="btn01 btn-success fadeInUp" /></a>
						</div>
							<!-- 確認ボタン -->
						<div class="col-sm-4 contact-left">
							<input type="submit" name="submit" value="Confirm" class="btn btn-success fadeInUp">
						</div>

						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>