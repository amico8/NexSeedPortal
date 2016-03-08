<div id="contact">
    <div class="contact fullscreen parallax">
        <div class="overlay02">
            <div class="container">
                <div class="row contact-row">
                    <div class="category col-sm-7 contact-right">
                    <?php if (isset($this->viewOptions) && !empty($this->viewOptions)): ?>
                        <form method="post" id="contact-form" class="form-horizontal" action="/NexSeedPortal/contents/edit_confirm/<?php echo $id; ?>">
                            <div class="btn-section dropdown01">
                                <select name="category_id" class="category" required>
                                        <option value="category">Category</option>
                                <?php foreach ($this->categories as $category): ?>
                                    <?php if ($category['category_id'] == $this->viewOptions['category_id']):?>
                                        <option value="<?php echo $category['category_id'];?>" selected><?php echo $category['category_name']; ?></option>
                                    <?php else: ?>
                                        <option value="<?php echo $category['category_id'];?>"><?php echo $category['category_name']; ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="category">
                                <input type="text" name="shop_name" id="storename" class="form-control input-lg" placeholder="Store name" value="<?php echo $this->viewOptions['shop_name']; ?>" required/>
                                <div class="abc">
                                    <span>Please Select Your Favorite Location!!</span>
                                    <!-- goolgle map API -->
                                    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
                                    <?php require('webroot/asset/js/gmap_edit.php'); ?>
                                    <div id="gmap"></div>
                                    <div id="lng">
                                        <input type="hidden" name="lng" id="lng" value="<?php echo $this->viewOptions['lng']; ?>">
                                    </div>
                                    <div id="lat">
                                        <input type="hidden" name="lat" id="lat" value="<?php echo $this->viewOptions['lat']; ?>">
                                    </div>
                                </div>
                                <input type="file" name="picture_path" placeholder="photo" class="form-control input-lg" value="">
                                <?php if (isset($error['picture_path']) && $error['picture_path'] == 'type') { ?>
                                  <p class="error">* 写真などは「.gif」または「.jpg」の画像を指定してください</p>
                                <?php } elseif (!empty($error)) { ?>
                                  <p class="error">* 恐れ入りますが画像を改めて指定してください</p>
                                <?php } ?>
                            </div>
                            <div class="abc">
                                <span>Review:</span>
                                <p class="abc01">
                                    <?php for ($i=1; $i<=5; $i++):?>
                                        <?php if($i == $this->viewOptions['review']): ?>
                                            <?php echo $i; ?>&nbsp;<input type="radio" name="review" value="<?php echo $i; ?>" checked required/>
                                        <?php else: ?>
                                            <?php echo $i; ?>&nbsp;<input type="radio" name="review" value="<?php echo $i; ?>" required/>
                                        <?php endif; ?>
                                    <?php endfor; ?>
                                </p>
                            </div>
                            <div class="category">
                                <textarea name="comment" rows="5" cols="10" id="comment" class="form-control input-message wow fadeInUp"  placeholder="Comment" required><?php echo $this->viewOptions['comment']; ?></textarea>
                            </div>
                            <div class="col-sm-4">
                                <a href='/NexSeedPortal/contents/show/<?php echo $id; ?>'>
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