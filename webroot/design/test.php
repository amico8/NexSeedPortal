<!DOCTYPE html>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<!-- /.website title -->
<title>NexSeed Portal</title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<!-- CSS Files -->
<link href="../asset/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="../asset/css/animate.css" rel="stylesheet" media="screen">
<link href="../asset/css/css-index.css" rel="stylesheet" media="screen">
<link href="../asset/css/font-awesome.css" rel="stylesheet">


<div id="menu">
	<nav class="navbar-wrapper navbar-default" role="navigation">
		<div class="container">
			  <div class="navbar-header">
				<a class="navbar-brand site-name" href="index.html"><img src="../asset/images/nex.png" alt="logo"></a>
			  </div>
	 		<!-- NAVIGATION -->
			  <div id="navbar-scroll" class="collapse navbar-collapse navbar-backyard navbar-right">
				<ul class="nav navbar-nav">
				<li>
					<div class="btn-section"><a href="join/index.html" button type="button" class="btn-default2">Logout</a></div>
				</li>
				</ul>
			  </div>
		</div>
	</nav>
</div>

<div id="contact">
	<div class="contact fullscreen parallax">
		<div class="overlay02">
			<div class="container">
				<div class="row contact-row">
					<!-- /.contact form -->
					<div class="col-sm-7 contact-right">
						<form method="POST" id="contact-form" class="form-horizontal" action="/NexSeedPortal/contents/confirm">
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
							<input type="text" name="Store Name" placeholder="Store Name" class="form-control input-lg" value="ダイコクドラッグ 寝屋川駅前店">
						</div>
							<!-- 場所の写真 -->
						<div class="category">
							<input type="text" name="Location" placeholder="Location" class="form-control input-lg" value="">
							<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
    						<script type="text/javascript" src="js/jquery.js"></script>
   							<script type="text/javascript" src="js/map.js"></script>
   							<div id="map" class="map01"></div>
						</div>
						<!-- <div align="right" style="float: right">
							<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
    						<script type="text/javascript" src="js/jquery.js"></script>
   							<script type="text/javascript" src="js/map.js"></script>
   							<div id="map" style="width:200px; height:200px"></div>
   						</div> -->
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
              				<textarea name="comment" rows="5" cols="10" id="comment" class="form-control input-message wow fadeInUp"  placeholder="Comment" required>なんでも安い。</textarea>
              			</div>
							<!-- 戻るボタン -->
						<div class="col-sm-4 contact-right">
							<input type="submit" name="submit" value="Back"class="btn01 btn-success wow fadeInUp" />
						</div>
							<!-- 確認ボタン -->
						<div class="col-sm-4 contact-left">
							<input type="submit" name="submit" value="Post" class="btn btn-success wow fadeInUp" />
						</div>
						 </form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /.footer -->
<footer id="footer">
  <div class="container">
    <div class="col-sm-4 col-sm-offset-4">
<div class="social text-center">
	<ul>
		<li><a class="wow fadeInUp" href="https://twitter.com/NexSeed_Cebu?lang=ja" target="_blank"><i class="fa fa-twitter"></i></a></li>
		<li><a class="wow fadeInUp" href="https://www.facebook.com/NexSeed/?ref=br_rs" target="_blank" data-wow-delay="0.2s"><i class="fa fa-facebook"></i></a></li>
	</ul>
</div>	
<div class="text-center wow fadeInUp" style="font-size: 14px;">Copyright NexSeed Portal since 2016</div>
<a href="#" class="scrollToTop"><i class="pe-7s-up-arrow pe-va"></i></a>

	<!-- /.javascript files -->
    <script src="../asset/js/jquery.js"></script>
    <script src="../asset/js/bootstrap.min.js"></script>
    <script src="../asset/js/custom.js"></script>
    <script src="../asset/js/jquery.sticky.js"></script>
	<script src="../asset/js/wow.min.js"></script>
	<script src="../asset/js/owl.carousel.min.js"></script>
	<script src="../asset/js/map.js"></script>
	<script>
	</script>
  </body>
</html>
</head>
</html>