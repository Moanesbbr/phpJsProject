<?php
include 'header.php';
?>

<div class="main main-raised">
	<div class="section">
		<div class="container">
			<div class="row">
				<div id="aside" class="col-md-3">
					<div id="get_category"></div>
					<div id="get_brand"></div>
					<div class="aside">
						<h3 class="aside-title">Top selling</h3>
						<div id="get_product_home"></div>
					</div>
				</div>
				<div id="store" class="col-md-9">
					<div class="row" id="product-row">
						<div class="col-md-12 col-xs-12" id="product_msg"></div>
						<div id="get_product">
							<?php
							include 'db.php';

							$search_query = "";
							if (isset($_GET['query'])) {
								$search_query = mysqli_real_escape_string($con, $_GET['query']);
							}

							$category_filter = "";
							if (isset($_GET['category']) && $_GET['category'] != 0) {
								$category_filter = "AND category_id = " . (int)$_GET['category'];
							}

							$sql = "SELECT * FROM products WHERE product_title LIKE '%$search_query%' $category_filter";
							$result = mysqli_query($con, $sql);

							if (mysqli_num_rows($result) > 0) {
								while ($row = mysqli_fetch_assoc($result)) {
									echo '
                                    <div class="col-md-4 col-xs-6">
                                        <div class="product">
                                            <div class="product-img">
                                                <img src="product_images/' . $row['product_image'] . '" alt="">
                                            </div>
                                            <div class="product-body">
                                                <h3 class="product-name"><a href="#">' . $row['product_title'] . '</a></h3>
                                                <h4 class="product-price">$' . $row['product_price'] . '</h4>
                                            </div>
                                        </div>
                                    </div>
                                    ';
								}
							} else {
								echo '<div class="col-md-12"><p>No products found matching your search criteria.</p></div>';
							}
							?>
						</div>
					</div>
					<div class="store-filter clearfix">
						<span class="store-qty">Showing 20-100 products</span>
						<ul class="store-pagination" id="pageno">
							<li><a class="active" href="#aside">1</a></li>
							<li><a href="#"><i class="fa fa-angle-right"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
include "newslettter.php";
include "footer.php";
?>