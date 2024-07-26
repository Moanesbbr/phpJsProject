<div class="main mainn-raised">
	<div class="container mainn-raised" style="width:100%;height: 60vh;">
		<div id="myCarousel" class="carousel slide" data-ride="carousel">
			<div class="carousel-inner">
				<div class="item active">
					<img src="img/banner3.jpg" alt="Los Angeles" style="width:100%;height: 60vh;">
				</div>
				<div class="item">
					<img src="img/banner2.jpg" style="width:100%;height: 60vh;">
				</div>
				<div class="item">
					<img src="img/banner4.jpg" alt="New York" style="width:100%;height: 60vh;">
				</div>
				<div class="item">
					<img src="img/banner1.jpg" alt="New York" style="width:100%;height: 60vh;">
				</div>
				<div class="item">
					<img src="img/banner3.jpg" alt="New York" style="width:100%;height: 60vh;">
				</div>
			</div>
			<a class="left carousel-control _26sdfg" href="#myCarousel" data-slide="prev">
				<span class="glyphicon glyphicon-chevron-left"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="right carousel-control _26sdfg" href="#myCarousel" data-slide="next">
				<span class="glyphicon glyphicon-chevron-right"></span>
				<span class="sr-only">Next</span>
			</a>
		</div>
	</div>

	<div class="section mainn mainn-raised">
		<div class="container">
			<div class="row">
				<div class="col-md-4 col-xs-6">
					<a href="product.php?p=78">
						<div class="shop">
							<div class="shop-img">
								<img src="./img/shop01.png" alt="">
							</div>
							<div class="shop-body">
								<h3>Laptop<br>Collection</h3>
								<a href="product.php?p=78" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
							</div>
						</div>
					</a>
				</div>
				<div class="col-md-4 col-xs-6">
					<a href="product.php?p=72">
						<div class="shop">
							<div class="shop-img">
								<img src="./img/shop03.png" alt="">
							</div>
							<div class="shop-body">
								<h3>Accessories<br>Collection</h3>
								<a href="product.php?p=72" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
							</div>
						</div>
					</a>
				</div>
				<div class="col-md-4 col-xs-6">
					<a href="product.php?p=79">
						<div class="shop">
							<div class="shop-img">
								<img src="./img/shop02.png" alt="">
							</div>
							<div class="shop-body">
								<h3>Cameras<br>Collection</h3>
								<a href="product.php?p=79" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
							</div>
						</div>
					</a>
				</div>
			</div>
		</div>
	</div>

	<div class="section">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="section-title">
						<h3 class="title">New Arrival Products</h3>
						<div class="section-nav">
							<ul class="section-tab-nav tab-nav">
								<li class="active"><a data-toggle="tab" href="#tab1">Camera</a></li>
								<li><a data-toggle="tab" href="#tab1">Smartphones</a></li>
								<li><a data-toggle="tab" href="#tab1">Mobile</a></li>
								<li><a data-toggle="tab" href="#tab1">Accessories</a></li>
							</ul>
						</div>
					</div>
				</div>

				<div class="col-md-12 mainn mainn-raised">
					<div class="row">
						<div class="products-tabs">
							<div id="tab1" class="tab-pane active">
								<div class="products-slick" data-nav="#slick-nav-1">
									<?php
									include 'db.php';
									$product_query = "SELECT * FROM products, categories WHERE product_cat=cat_id AND product_id BETWEEN 70 AND 75";
									$run_query = mysqli_query($con, $product_query);
									if (mysqli_num_rows($run_query) > 0) {
										while ($row = mysqli_fetch_array($run_query)) {
											$pro_id    = $row['product_id'];
											$pro_cat   = $row['product_cat'];
											$pro_brand = $row['product_brand'];
											$pro_title = $row['product_title'];
											$pro_price = $row['product_price'];
											$pro_image = $row['product_image'];
											$pro_dis = $row['product_discount'];
											$cat_name = $row["cat_title"];
											echo "
                                                <div class='product'>
                                                    <a href='product.php?p=$pro_id'>
                                                        <div class='product-img'>
                                                            <img src='product_images/$pro_image' style='max-height: 170px;' alt=''>
                                                            <div class='product-label'>
                                                                <span class='sale'>-30%</span>
                                                                <span class='new'>NEW</span>
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <div class='product-body'>
                                                        <p class='product-category'>$cat_name</p>
                                                        <h3 class='product-name header-cart-item-name'><a href='product.php?p=$pro_id'>$pro_title</a></h3>
                                                        <h4 class='product-price header-cart-item-info'>Rs. $pro_price <del class='product-old-price'>Rs. $pro_dis</del></h4>
                                                    </div>
                                                    <div class='add-to-cart'>
                                                        <button pid='$pro_id' id='product' class='add-to-cart-btn block2-btn-towishlist' href='#'><i class='fa fa-shopping-cart'></i> add to cart</button>
                                                    </div>
                                                </div>
                                            ";
										}
									}
									?>
								</div>
								<div id="slick-nav-1" class="products-slick-nav"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div id="hot-deal" class="section mainn mainn-raised">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="hot-deal">
						<ul class="hot-deal-countdown">
							<li>
								<div>
									<h3>05</h3><span>Days</span>
								</div>
							</li>
							<li>
								<div>
									<h3>10</h3><span>Hours</span>
								</div>
							</li>
							<li>
								<div>
									<h3>40</h3><span>Mins</span>
								</div>
							</li>
							<li>
								<div>
									<h3>60</h3><span>Secs</span>
								</div>
							</li>
						</ul>
						<h2 class="text-uppercase">hot deal this week</h2>
						<p>Save upto 50% OFF</p>
						<a class="primary-btn cta-btn" href="store.php">Buy now</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="section">
		<div class="container">
			<div class="row">
				<div class="col-md-4 col-xs-6">
					<div class="section-title">
						<h4 class="title">Top Mobile Product</h4>
						<div class="section-nav">
							<div id="slick-nav-3" class="products-slick-nav"></div>
						</div>
					</div>
					<div class="products-widget-slick" data-nav="#slick-nav-3">
						<div id="get_product_home">
							<?php
							// Fetch top mobile products
							$mobile_query = "SELECT * FROM products WHERE product_cat = (SELECT cat_id FROM categories WHERE cat_title = 'Mobile') LIMIT 3";
							$run_mobile_query = mysqli_query($con, $mobile_query);
							if (mysqli_num_rows($run_mobile_query) > 0) {
								while ($row = mysqli_fetch_array($run_mobile_query)) {
									$pro_id    = $row['product_id'];
									$pro_cat   = $row['product_cat'];
									$pro_title = $row['product_title'];
									$pro_price = $row['product_price'];
									$pro_image = $row['product_image'];
									$pro_dis = $row['product_discount'];
									echo "
                                        <div class='product-widget'>
                                            <div class='product-img'>
                                                <img src='product_images/$pro_image' alt=''>
                                            </div>
                                            <div class='product-body'>
                                                <p class='product-category'>Mobile</p>
                                                <h3 class='product-name'><a href='product.php?p=$pro_id'>$pro_title</a></h3>
                                                <h4 class='product-price'>Rs. $pro_price <del class='product-old-price'>Rs. $pro_dis</del></h4>
                                            </div>
                                        </div>
                                    ";
								}
							}
							?>
						</div>
					</div>
				</div>

				<div class="col-md-4 col-xs-6">
					<div class="section-title">
						<h4 class="title">Top Laptop Product</h4>
						<div class="section-nav">
							<div id="slick-nav-4" class="products-slick-nav"></div>
						</div>
					</div>
					<div class="products-widget-slick" data-nav="#slick-nav-4">
						<div id="get_product_home2">
							<?php
							// Fetch top laptop products
							$laptop_query = "SELECT * FROM products WHERE product_cat = (SELECT cat_id FROM categories WHERE cat_title = 'Laptop') LIMIT 3";
							$run_laptop_query = mysqli_query($con, $laptop_query);
							if (mysqli_num_rows($run_laptop_query) > 0) {
								while ($row = mysqli_fetch_array($run_laptop_query)) {
									$pro_id    = $row['product_id'];
									$pro_cat   = $row['product_cat'];
									$pro_title = $row['product_title'];
									$pro_price = $row['product_price'];
									$pro_image = $row['product_image'];
									$pro_dis = $row['product_discount'];
									echo "
                                        <div class='product-widget'>
                                            <div class='product-img'>
                                                <img src='product_images/$pro_image' alt=''>
                                            </div>
                                            <div class='product-body'>
                                                <p class='product-category'>Laptop</p>
                                                <h3 class='product-name'><a href='product.php?p=$pro_id'>$pro_title</a></h3>
                                                <h4 class='product-price'>Rs. $pro_price <del class='product-old-price'>Rs. $pro_dis</del></h4>
                                            </div>
                                        </div>
                                    ";
								}
							}
							?>
						</div>
					</div>
				</div>

				<div class="col-md-4 col-xs-6">
					<div class="section-title">
						<h4 class="title">Top Accessories Collection</h4>
						<div class="section-nav">
							<div id="slick-nav-5" class="products-slick-nav"></div>
						</div>
					</div>
					<div class="products-widget-slick" data-nav="#slick-nav-5">
						<div>
							<?php
							// Fetch top accessories products
							$accessories_query = "SELECT * FROM products WHERE product_cat = (SELECT cat_id FROM categories WHERE cat_title = 'Accessories') LIMIT 3";
							$run_accessories_query = mysqli_query($con, $accessories_query);
							if (mysqli_num_rows($run_accessories_query) > 0) {
								while ($row = mysqli_fetch_array($run_accessories_query)) {
									$pro_id    = $row['product_id'];
									$pro_cat   = $row['product_cat'];
									$pro_title = $row['product_title'];
									$pro_price = $row['product_price'];
									$pro_image = $row['product_image'];
									$pro_dis = $row['product_discount'];
									echo "
                                        <div class='product-widget'>
                                            <div class='product-img'>
                                                <img src='product_images/$pro_image' alt=''>
                                            </div>
                                            <div class='product-body'>
                                                <p class='product-category'>Accessories</p>
                                                <h3 class='product-name'><a href='product.php?p=$pro_id'>$pro_title</a></h3>
                                                <h4 class='product-price'>Rs. $pro_price <del class='product-old-price'>Rs. $pro_dis</del></h4>
                                            </div>
                                        </div>
                                    ";
								}
							}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>