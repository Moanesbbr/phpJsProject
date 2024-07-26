<?php
include 'header.php';
?>
<script id="jsbin-javascript">
	(function(global) {
		if (typeof(global) === "undefined") {
			throw new Error("window is undefined");
		}
		var _hash = "!";
		var noBackPlease = function() {
			global.location.href += "#";
			global.setTimeout(function() {
				global.location.href += "!";
			}, 50);
		};
		global.onhashchange = function() {
			if (global.location.hash !== _hash) {
				global.location.hash = _hash;
			}
		};
		global.onload = function() {
			noBackPlease();
			document.body.onkeydown = function(e) {
				var elm = e.target.nodeName.toLowerCase();
				if (e.which === 8 && (elm !== 'input' && elm !== 'textarea')) {
					e.preventDefault();
				}
				e.stopPropagation();
			};
		};
	})(window);
</script>
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
						<div id="get_product"></div>
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