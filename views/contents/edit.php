<div id="contact">
    <div class="contact fullscreen parallax">
        <div class="overlay02">
            <div class="container">
                <div class="row contact-row">
                    <div class="category col-sm-7 contact-right">
                    <?php if (isset($this->viewOptions) && !empty($this->viewOptions)): ?>
                        <form method="POST" id="contact-form" class="form-horizontal" action="edit_check.html">
                            <div class="btn-section dropdown01">
                                <select name="category" class="category">
                                    <option value="category">カテゴリ</option>
                                <?php foreach ($this->categories as $category): ?>
                                    <option value="<?php echo $category['category_id'];?>"><?php echo $category['category_name']; ?></option>
                                <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="category">
                                <input type="text" name="storename" id="storename" class="form-control input-lg" placeholder="Store name" value="<?php echo $this->viewOptions['shop_name']; ?>" required/>
                                <div class="abc">
                                    <span>Please Select Your Favorite Location!!</span>
                                    <!-- goolgle map API -->
                                    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
                                    <?php require('webroot/asset/js/gmap_edit.php'); ?>
                                    <div id="gmap"></div>
                                </div>
                                <input type="file" name="Photo" placeholder="Photo" class="form-control input-lg" value="">
                            </div>
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
                            <div class="category">
                                <textarea name="comment" rows="5" cols="10" id="comment" class="form-control input-message wow fadeInUp"  placeholder="Comment" required><?php echo $this->viewOptions['comment']; ?></textarea>
                            </div>
                            <div class="col-sm-4">
                                <a href='/NexSeedPortal/contents/show'>
                                    <input type="button" name="button" value="Back" class="btn01 wow fadeInUp" />
                                </a>
                            </div>
                            <!-- 確認ボタン -->
                            <div class="col-sm-4 contact-left">
                                <input type="submit" name="submit" value="Edit" class="btn wow fadeInUp" />
                            </div>
                        </form>
                    <?php else: ?>
                        <p>This post couldn't found out. Please check your URL.</br>Thank you.</p>
                    <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>