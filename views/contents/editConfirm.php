<div id="contact">
    <div class="contact fullscreen parallax">
        <div class="overlay02">
            <div class="container">
                <div class="wow fadeInUp row contact-row">
                    <div class="col-md-8 contact-right">
                        <form method="post" id="contact-form" class="form-horizontal" action="/NexSeedPortal/contents/update/<?php echo $id; ?>">
                            <input type="hidden" name="action" value="submit">
                        <div class="wow fadeInUp well">ご登録内容をご確認ください。</div>
                            <table class="wow fadeInUp table table-condensed">
                                <tbody>
                                    <tr>
                                        <td><div class="text-center">Category</div></td>
                                        <td>
                                            <div class="text-center">
                                                <?php foreach ($this->categories as $category) {
                                                        if($_SESSION['edit']['category_id'] == $category['category_id']) {
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
                                                <?php echo htmlspecialchars($_SESSION['edit']['shop_name']); ?>
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
                                                <?php //echo $this->session['picture_path']; ?>
                                                <?php //var_dump($this->files); ?>
                                                <?php //var_dump($files); ?>
                                                <?php //var_dump($_SESSION['edit']); ?>
                                                <?php //var_dump($this->post); ?>
                                                <?php //var_dump($this->session); ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><div class="text-center">Photo</div></td>
                                        <td>
                                            <div class="text-center">
                                                <?php if (isset($fileName) && !empty($fileName)): ?>
                                                    <img src="/NexSeedPortal/webroot/asset/images/post_images/<?php echo $this->files; ?>" width="250" height="250">
                                                <?php else: ?>
                                                    Image has not been selected.
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><div class="text-center">Review</div></td>
                                        <td id="review">
                                            <div class="text-center">
                                                <?php 
                                                    $i = $_SESSION['edit']['review'];
                                                    for ($i; $i>0; $i--) {
                                                        echo "★";
                                                    }
                                                ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><div class="text-center">Comment</div></td>
                                        <td>
                                            <div class="text-center">
                                                <?php echo htmlspecialchars($_SESSION['edit']['comment']); ?>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        <!-- 戻るボタン -->
                        <div class="col-sm-4 contact-right">
                            <a href="/NexSeedPortal/contents/edit/<?php echo $id; ?>"><input type="button" name="submit" value="Back" class="btn01 btn-success wow fadeInUp" /></a>
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