<?php
session_start();
include("./includes/db.php");

if (isset($_POST['btn_save'])) {
  $product_name = $_POST['product_name'];
  $details = $_POST['details'];
  $price = $_POST['price'];
  $product_type = $_POST['product_type'];
  $brand = $_POST['brand'];
  $tags = $_POST['tags'];
  $qty = $_POST['qty'];
  $discount = $_POST['discount'];

  // picture coding
  $picture_name = $_FILES['picture']['name'];
  $picture_type = $_FILES['picture']['type'];
  $picture_tmp_name = $_FILES['picture']['tmp_name'];
  $picture_size = $_FILES['picture']['size'];

  if ($picture_type == "image/jpeg" || $picture_type == "image/jpg" || $picture_type == "image/png" || $picture_type == "image/gif") {
    if ($picture_size <= 50000000) {
      $pic_name = time() . "_" . $picture_name;
      $target_dir = __DIR__ . "/../product_images/"; // Corrected path
      if (move_uploaded_file($picture_tmp_name, $target_dir . $pic_name)) {
        mysqli_query($con, "INSERT INTO products (product_cat, product_brand, product_title, product_price, product_desc, product_image, product_keywords, qty, product_discount) VALUES ('$product_type', '$brand', '$product_name', '$price', '$details', '$pic_name', '$tags', '$qty', '$discount')") or die("query incorrect");

        header("location: sumit_form.php?success=1");
      } else {
        echo "Failed to upload image.";
      }
    }
  }

  mysqli_close($con);
}

// Fetch categories and brands from database
$categories_query = "SELECT * FROM categories";
$brands_query = "SELECT * FROM brands";

$categories_result = mysqli_query($con, $categories_query);
$brands_result = mysqli_query($con, $brands_query);

include "sidenav.php";
include "topheader.php";
?>
<!-- End Navbar -->
<div class="content">
  <div class="container-fluid">
    <form action="" method="post" enctype="multipart/form-data">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header card-header-primary">
              <h5 class="title">Add Product</h5>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label>Product Title</label>
                <input type="text" id="product_name" required name="product_name" class="form-control">
              </div>
              <div class="form-group">
                <label for="picture">Add Image</label>
                <input type="file" name="picture" required class="form-control-file" id="picture" onchange="previewImage(event)">
                <img id="imagePreview" src="#" alt="Image Preview" style="display: none; margin-top: 10px; max-width: 100%; height: auto;">
              </div>
              <div class="form-group">
                <label>Description</label>
                <textarea rows="4" cols="80" id="details" required name="details" class="form-control"></textarea>
              </div>
              <div class="form-group">
                <label>Pricing</label>
                <input type="text" id="price" name="price" required class="form-control">
              </div>
              <div class="form-group">
                <label>Product Category</label>
                <select id="product_type" name="product_type" required class="form-control">
                  <option value="">Select Category</option>
                  <?php
                  while ($row = mysqli_fetch_assoc($categories_result)) {
                    echo "<option value='" . $row['cat_id'] . "'>" . $row['cat_title'] . "</option>";
                  }
                  ?>
                </select>
              </div>
              <div class="form-group">
                <label>Product Brand</label>
                <select id="brand" name="brand" required class="form-control">
                  <option value="">Select Brand</option>
                  <?php
                  while ($row = mysqli_fetch_assoc($brands_result)) {
                    echo "<option value='" . $row['brand_id'] . "'>" . $row['brand_title'] . "</option>";
                  }
                  ?>
                </select>
              </div>
              <div class="form-group">
                <label>Product Keywords</label>
                <input type="text" id="tags" name="tags" required class="form-control">
              </div>
              <div class="form-group">
                <label>Product Quantity</label>
                <input type="text" id="quantity" name="qty" required class="form-control">
              </div>
              <div class="form-group">
                <label>Discount</label>
                <input type="text" id="discount" name="discount" required class="form-control">
              </div>
            </div>
            <div class="card-footer">
              <button type="submit" id="btn_save" name="btn_save" required class="btn btn-fill btn-primary">Add Product</button>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
<script>
  function previewImage(event) {
    var reader = new FileReader();
    reader.onload = function() {
      var output = document.getElementById('imagePreview');
      output.src = reader.result;
      output.style.display = 'block';
    };
    reader.readAsDataURL(event.target.files[0]);
  }
</script>
<?php
include "footer.php";
?>