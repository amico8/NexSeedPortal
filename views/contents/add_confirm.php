<div id="contact">
    <div class="contact fullscreen parallax">
        <div class="overlay02">
            <div class="container">
                <div class="row contact-row">
                    <div class="col-sm-7 contact-right">
                        <form method="POST" id="contact-form" class="form-horizontal" action="contactengine.php" onSubmit="alert('Thank you for your feedback!');">

                <!-- <div class="container"> -->
                  <!-- <div class="row"> -->
                   <!-- <div class="col-sm-7 contact-right"> -->
                          <!-- <form method="POST" id="contact-form" class="form-horizontal" action="contactengine.php" onSubmit="alert('Thank you for your feedback!');"> -->
                        <!-- <input type="hidden" name="action" value="submit"> -->
                            <div class="well">ご登録内容をご確認ください。</div>
                                <table class="table">
                                  <!-- <table class="table table-striped table-condensed"> -->
                                    <tbody>
                                      <!-- 登録内容を表示 -->
                                        <tr class="sample1">
                                            <td><div class="text-center">Category</div></td>
                                            <td><div class="text-center"><?php echo $this->session['Category']; ?></div></td>
                                        </tr>
                                        <tr class="sample1">
                                            <td><div class="text-center">Store Name</div></td>
                                            <td><div class="text-center"><?php echo $this->session['Store Name']; ?></div></td>
                                        </tr>
                                        <tr class="sample1">
                                            <td><div class="text-center">Location</div></td>
                                            
                                            <td>
                                                <meta http-equiv="content-type" content="text/html; charset=utf-8" />
                                                <!-- googlemap API -->
                                                <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
                                                <!-- googlemap API 実装 -->
                                                <script type="text/javascript">
                                                    google.maps.event.addDomListener(window, 'load', function()
                                                    {
                                                        // La Guardia Flats2の経緯度
                                                        var lng = <?php echo $this->session['Location']; ?>
                                                        var lat = <?php echo $this->session['Location']; ?>
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

                                            <body>
                                            <!-- <div id="gmap" style="width: 500px; height: 370px; border: 1px solid Gray;"></div> -->
                                            <div id="gmap" class="map01"style=""></div>
                                            </body>
                                            </td>
                                        </tr>
                                        <tr class="sample1">
                                            <td><div class="text-center">Photo</div></td>
                                            <td><div class="text-center"><img src="<?php echo $this->session['Photo']; ?>" width="100" height="100"></div></td>
                                        </tr>
                                        <tr class="sample1">
                                            <td><div class="text-center">Review</div></td>
                                            <td class="review"><div class="text-center"><?php echo $this->session['review']; ?></div></td>
                                        </tr>
                                        <tr class="sample1">
                                            <td><div class="text-center">Comment</div></td>
                                            <td><div class="text-center"><?php echo $this->session['comment']; ?></div></td>
                                        </tr>
                                    </tbody>
                                </table>

                              <!-- 戻るボタン -->
                            <div class="col-sm-4 contact-right">
                            <a href='/NexSeedPortal/contents/show/<?php echo $id; ?>'>
                                <input type="submit" name="submit" value="Back"class="btn01 btn-success wow fadeInUp" />
                            </a>
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