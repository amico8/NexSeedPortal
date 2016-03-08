<div id="contact">
    <div class="contact fullscreen parallax">
        <div class="overlay02">
            <div class="container">
                <div class="row contact-row">
                    <div class="col-md-8 contact-right">
                        <form method="post" id="contact-form" class="form-horizontal" action="/NexSeedPortal/contents/show/<?php echo $id; ?>" onSubmit="alert('Thank you for your feedback!');">
                            <input type="hidden" name="action" value="submit">
                        <div class="well">ご登録内容をご確認ください。</div>
                            <table class="table table-condensed">
                                <tbody>
                                    <tr>
                                        <td><div class="text-center">Category</div></td>
                                        <td>
                                            <div class="text-center">
                                                <?php foreach ($this->categories as $category) {
                                                        if($_POST['category_id'] == $category['category_id']) {
                                                            echo $category['category_name'];
                                                        }
                                                    }
                                                 ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><div class="text-center">Store Name</div></td>
                                        <td>
                                            <div class="text-center">
                                                <?php echo htmlspecialchars($_POST['shop_name']); ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><div class="text-center">Location</div></td>
                                        <td>
                                            <!-- goolgle map API -->
                                            <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
                                            <?php require('webroot/asset/js/gmap.php'); ?>
                                            <div id="gmap"></div>
                                        </td>
                                        <td>
                                            <div class="text-center">
                                                <?php echo htmlspecialchars($_POST['lat']) ?></br>
                                                <?php echo htmlspecialchars($_POST['lng']) ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><div class="text-center">Photo</div></td>
                                        <td>
                                            <div class="text-center">
                                                <img src="/NexSeedPortal/webroot/asset/images/post_images/<?php echo $_POST['picture_path']; ?>.jpg" width="100" height="100">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><div class="text-center">Review</div></td>
                                        <td class="review">
                                            <div class="text-center">
                                                <?php echo htmlspecialchars($_POST['review']); ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><div class="text-center">Comment</div></td>
                                        <td>
                                            <div class="text-center">
                                                <?php echo htmlspecialchars($_POST['comment']); ?>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        <!-- 戻るボタン -->
                        <div class="col-sm-4 contact-right">
                            <input type="submit" name="submit" value="Back" class="btn01 btn-success wow fadeInUp" />
                        </div>
                        <div class="col-sm-4 contact-left">
                            <input type="submit" name="submit" value="Update" class="btn btn-success wow fadeInUp"/>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>