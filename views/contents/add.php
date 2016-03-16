<div id="contact">
	<div class="contact fullscreen parallax">
		<div class="overlay02">
			<div class="container">
				<div class="row contact-row">
					<!-- /.contact form -->
					<div class="col-sm-7 contact-right">
						<form method="post" id="contact-form" class="form-horizontal" action="/NexSeedPortal/contents/confirm"  enctype="multipart/form-data">
							<!-- カテゴリ -->
						<div class="btn-section dropdown01">
						 <!-- <select class="" name="Category"> -->
						 <select class="category" name="category_id">

							<option value="1">Category</option>
							<?php foreach ($this->categories as $category): ?>
                                    <?php if ($category['category_id'] == $this->viewOptions['category_id']):?>
                                        <option value="<?php echo $category['category_id'];?>" selected><?php echo $category['category_name']; ?></option>
                                    <?php else: ?>
                                        <option value="<?php echo $category['category_id'];?>"><?php echo $category['category_name']; ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
						 </select>
						</div>
							<!-- 店の名前 -->
						<div class="category">
							<!-- <input type="text" name="StoreName" placeholder="Store Name" class="form-control input-lg" value="" required> -->
						<input type="text" name="shop_name" placeholder="Store Name" class="form-control input-lg" value="" required>

							<?php if(isset($erorr['Store_Name']) && $erorr['Store_Name'] == 'blank'): ?>
			                <p class="post">* 名前を入れてください。</p>
			              <?php endif; ?>
						<!-- </div> -->
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
   						 <!-- <meta http-equiv="content-type" content="text/html; charset=utf-8" /> -->
   						<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
                        <?php require('webroot/asset/js/gmap_add.php'); ?>
					    <div id="gmap" class="map01" style=""></div>
					     <div id="lng">
                        </div>
                        <div id="lat">
                        </div>

							<!-- 写真 -->
						<div class="category">

				           	<input type="file" name="Photo" placeholder="Photo" class="form-control input-lg" value="" >
                                <?php if (isset($_SESSION['error']) && !empty($_SESSION['error']) && $_SESSION['error'] == 'error_prefix'): ?>
                                    <p class="danger">※画像の拡張子は".jpg"または".png"または".gif"のファイルを選択して下さい。</p>
                                <?php elseif (isset($_SESSION['error']) && !empty($_SESSION['error']) && $_SESSION['error'] == 'select_again'): ?>
                                    <p class="danger">※恐れ入りますがもう一度画像ファイルを選択して下さい。</p>
                                <?php elseif (isset($_SESSION['error']) && !empty($_SESSION['error']) && $_SESSION['error'] == 'no_error'): ?>
                                    <?php false; ?>
                                <?php endif; ?>
				        </div>
								<!-- 評価 -->
						<div class="abc">
                		<span>Review:</span>
                			<p class="abc01">
                   			<!-- 1<input type="radio" name="point" value="1">
                    		2<input type="radio" name="point" value="2">
                    		3<input type="radio" name="point" value="3" checked>
                    		4<input type="radio" name="point" value="4">
                    		5<input type="radio" name="point" value="5"> -->
                    			1<input type="radio" name="review" value="1">
	                    		2<input type="radio" name="review" value="2">
	                    		3<input type="radio" name="review" value="3" checked>
	                    		4<input type="radio" name="review" value="4">
	                    		5<input type="radio" name="review" value="5">
                			</p>
              			</div>
						<!-- </tr> -->
							 <!-- コメント -->

						<div class="category">
              				<textarea name="comment" rows="5" cols="10" id="comment" class="form-control input-message fadeInUp"  placeholder="Comment" required></textarea>
              			</div>
							<!-- 戻るボタン -->
						<div class="col-sm-4 contact-right">
							<!-- <a href="/NexSeedPortal/contents/index/"><input type="button" name="bitton" value="Back"class="btn01 btn-success fadeInUp" /></a> -->
						<a href="/NexSeedPortal/contents/index/">
							<input type="button" name="bitton" value="Back"class="btn01 btn-success fadeInUp" />
						</a>

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