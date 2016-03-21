<div id="contact">
	<div class="contact fullscreen parallax">
		<div class="overlay02">
			<div class="container">
				<div class="row contact-row">
					<div class="col-sm-7 contact-right">
						<form method="POST" id="contact-form" class="form-horizontal" action="">
							<div class="well">ご登録内容をご確認ください。</div>
								<table class="table">
									<tbody>
										<tr class="sample1">
											<td><div class="text-center">Category</div></td>
											<td>
												<div class="text-center">
												<?php foreach ($this->categories as $category) {
														if($_SESSION['add']['category_id'] == $category['category_id']) {
															echo $category['category_name'];
														}
													}
												 ?>
												</div>
											</td>
										</tr>
										<tr class="sample1">
											<td><div class="text-center">Shop Name</div></td>
											<td><div class="text-center"><?php echo htmlspecialchars($_SESSION['add']['shop_name']); ?></div></td>
										</tr>
										<tr class="sample1">
										<td><div class="text-center">Location</div></td>
										<td>
											<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
											<?php require('webroot/asset/js/gmap.php'); ?>
											<div id="gmap" style="width: 200px; height: 150px; border: 1px solid Gray;"></div>
										</td>
										</tr>
										<tr class="sample1">
											<td><div class="text-center">Photo</div></td>
											<td>
												<?php if (isset($_SESSION['add']['picture_path']) && !empty($_SESSION['add']['picture_path'])): ?>
													<img src="/NexSeedPortal/webroot/asset/images/post_images/<?php echo $_SESSION['add']['picture_path']; ?>" width="500" height="370">
												<?php else: ?>
													Image has not been selected.
												<?php endif; ?>
											</td>
										</tr>
										<tr class="sample1">
											<td><div class="text-center">Review</div></td>
											<td class="review">
												<div class="text-center">
													<?php
														$i = $_SESSION['add']['review'];
														for ($i; $i>0; $i--) {
															echo "★";
														}
													?>
												</div>
											</td>
										</tr>
										<tr class="sample1">
											<td><div class="text-center">Comment</div></td>
											<td><div class="text-center"><?php echo htmlspecialchars($_SESSION['add']['comment']); ?></div></td>
										</tr>
									</tbody>
								</table>
							<div class="col-sm-4 contact-right">
								<a href='/NexSeedPortal/contents/add'>
									<input type="button" name="submit" value="Back"class="btn01 btn-success wow fadeInUp" />
								</a>
							</div>
							<div class="col-sm-4 contact-left">
								<a href='/NexSeedPortal/contents/create'>
									<input type="button" name="submit" value="Post" class="btn btn-success wow fadeInUp" />
								</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>