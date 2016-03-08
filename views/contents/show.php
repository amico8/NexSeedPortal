<div id="contact">
    <div class="contact fullscreen parallax">
        <div class="overlay02">
            <div class="container">
                <div class="row contact-row">
                    <div class="col-md-9 contact-right">
                    <?php if (isset($this->viewOptions) && !empty($this->viewOptions)): ?>
                        <div class="well2">
                            <p>
                            <div class="col-md-10 contact-left"><?php echo $this->viewOptions['shop_name']; ?>の店舗情報</div>
                            <div class="contact-right">
                                <a href="/NexSeedPortal/contents/edit/<?php echo $id; ?>">
                                <i class="fa fa-pencil fa-glay"></i>
                                </a>　
                                <a href="/NexSeedPortal/contents/delete/<?php echo $id; ?>" onclick="return confirm('Are you sure you want to delete?');">
                                <i class="fa fa-trash fa-glay"></i>
                                </a>
                            </div>
                            </p>
                        </div>
                            <br />
                        <table class="table table-condensed">
                            <tr>
                                <td>Store Name</td>
                                <td>
                                    <div class="text-center">
                                        <?php echo $this->viewOptions['shop_name']; ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Category</td>
                                <td>
                                    <div class="text-center">
                                        <?php echo $this->viewOptions['category_name']; ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Review</td>
                                <td class="review">
                                    <div class="text-center">
                                        <?php 
                                            $i = $this->viewOptions['review'];
                                            for ($i; $i>0; $i--) {
                                                echo "★";
                                            }
                                        ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Comment</td>
                                <td>
                                    <div class="text-center">
                                        <?php echo $this->viewOptions['comment']; ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Photo</td>
                                <td>
                                    <div class="text-center">
                                        <?php echo $this->viewOptions['picture_path']; ?>
                                        <img src="/NexSeedPortal/webroot/asset/images/picture.jpg" alt="写真" width="500" height="370">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Location</td>
                                <td>
                                    <!-- goolgle map API -->
                                    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
                                    <?php require('webroot/asset/js/gmap.php'); ?>
                                    <div id="gmap"></div>
                                </td>
                            </tr>
                            <tr>
                                <td>Date</td>
                                <td>
                                    <div class="text-center">
                                        <?php echo $this->viewOptions['created']; ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Reviewer</td>
                                <td>
                                    <div class="text-center">
                                        <?php echo $this->viewOptions['user_name']; ?>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    <?php else: ?>
                        <p>This post couldn't find out. Please check your URL.</br>Thank you.</p>
                    <?php endif; ?>
                            <br />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>