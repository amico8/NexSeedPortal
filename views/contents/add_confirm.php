<?php// var_dump($_SEESION); ?>
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
                            <?php var_dump($_POST); ?>
                                <table class="table">
                                  <!-- <table class="table table-striped table-condensed"> -->
                                    <tbody>
                                      <!-- 登録内容を表示 -->
                                        <tr class="sample1">
                                            <td><div class="text-center">Category</div></td>
                                            <td><div class="text-center">
                                                <?php foreach ($this->categories as $category) {
                                                        if($_POST['category_id'] == $category['category_id']) {
                                                            echo $category['category_name'];
                                                        }
                                                    }
                                                 ?>
                                            </div></td>
                                        </tr>
                                        <tr class="sample1">
                                            <td><div class="text-center">Store Name</div></td>
                                            <td><div class="text-center"><?php echo htmlspecialchars($_POST['StoreName']); ?></div></td>
                                        </tr>
                                        <tr class="sample1">
                                        <td><div class="text-center">Location</div></td>
                                        <td>
                                            <!-- goolgle map API -->
                                            <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>

                                            <!-- ここにphpで書かれたrequire関数が後で入る エラーが出て進まなくなるので一時的にコード削除 後ほど追加予定 -->
                                            
                                            <div id="gmap"></div>
                                        </td>
                                        <td>
                                            <div class="text-center">
                                            
                                            <!-- ここに地図のコードが後で入る -->
                                            
                                            </div>
                                        </td>
                                        </tr>
                                        <tr class="sample1">
                                            <td><div class="text-center">Photo</div></td>
                                            <img src="/NexSeedPortal/webroot/asset/images/post_images/<?php echo $_POST['picture_path']; ?>.jpg" width="100" height="100">
                                        </tr>
                                        <tr class="sample1">
                                            <td><div class="text-center">Review</div></td>
                                            <td class="review">
                                                <div class="text-center">
                                                    <?php 
                                                        $i = $_POST['point'];
                                                        for ($i; $i>0; $i--) {
                                                            echo "★";
                                                        }
                                                    ?>
                                                </div>
                                            </td>
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