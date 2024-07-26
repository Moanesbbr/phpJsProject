<?php
session_start();
include("includes/db.php");

$product_id = $_REQUEST['product_id'];
$result = mysqli_query($con, "SELECT product_id, product_cat, product_title, product_price, product_discount, product_brand, product_image FROM products WHERE product_id='$product_id'") or die("query 1 incorrect.......");

list($product_id, $product_cat, $product_title, $product_price, $product_discount, $product_brand, $product_image) = mysqli_fetch_array($result);

if (isset($_POST['btn_save'])) {
  $product_cat = $_POST['product_cat'];
  $product_title = $_POST['product_title'];
  $product_price = $_POST['product_price'];
  $product_discount = $_POST['product_discount'];
  $product_brand = $_POST['product_brand'];

  // Picture handling
  if (!empty($_FILES['picture']['name'])) {
    $picture_name = $_FILES['picture']['name'];
    $picture_type = $_FILES['picture']['type'];
    $picture_tmp_name = $_FILES['picture']['tmp_name'];
    $picture_size = $_FILES['picture']['size'];

    if ($picture_type == "image/jpeg" || $picture_type == "image/jpg" || $picture_type == "image/png" || $picture_type == "image/gif") {
      if ($picture_size <= 50000000) {
        $pic_name = time() . "_" . $picture_name;
        $target_dir = __DIR__ . "/../product_images/";

        // Delete old picture
        $old_picture_path = $target_dir . $product_image;
        if (file_exists($old_picture_path)) {
          unlink($old_picture_path);
        }

        // Upload new picture
        if (move_uploaded_file($picture_tmp_name, $target_dir . $pic_name)) {
          $product_image = $pic_name;
        } else {
          echo "Failed to upload image.";
        }
      }
    }
  }

  mysqli_query($con, "UPDATE products SET product_cat='$product_cat', product_title='$product_title', product_price='$product_price', product_discount='$product_discount', product_brand='$product_brand', product_image='$product_image' WHERE product_id='$product_id'") or die("Query 2 is incorrect..........");

  header("location: productlist.php");
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
              <h5 class="title">Edit Product</h5>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label>Product Title</label>
                <input type="text" id="product_title" required name="product_title" class="form-control" value="<?php echo $product_title; ?>">
              </div>
              <div class="form-group">
                <label for="picture">Add Image</label>
                <input type="file" name="picture" class="form-control-file" id="picture" onchange="previewImage(event)">
                <img id="imagePreview" src="../product_images/<?php echo $product_image; ?>" alt="Image Preview" style="display: block; margin-top: 10px; max-width: 100%; height: auto;">
              </div>
              <div class="form-group">
                <label>Pricing</label>
                <input type="text" id="product_price" name="product_price" required class="form-control" value="<?php echo $product_price; ?>">
              </div>
              <div class="form-group">
                <label>Product Category</label>
                <select id="product_cat" name="product_cat" required class="form-control">
                  <option value="">Select Category</option>
                  <?php
                  while ($row = mysqli_fetch_assoc($categories_result)) {
                    $selected = ($row['cat_id'] == $product_cat) ? "selected" : "";
                    echo "<option value='" . $row['cat_id'] . "' $selected>" . $row['cat_title'] . "</option>";
                  }
                  ?>
                </select>
              </div>
              <div class="form-group">
                <label>Product Brand</label>
                <select id="product_brand" name="product_brand" required class="form-control">
                  <option value="">Select Brand</option>
                  <?php
                  while ($row = mysqli_fetch_assoc($brands_result)) {
                    $selected = ($row['brand_id'] == $product_brand) ? "selected" : "";
                    echo "<option value='" . $row['brand_id'] . "' $selected>" . $row['brand_title'] . "</option>";
                  }
                  ?>
                </select>
              </div>
              <div class="form-group">
                <label>Discount</label>
                <input type="text" id="product_discount" name="product_discount" required class="form-control" value="<?php echo $product_discount; ?>">
              </div>
            </div>
            <div class="card-footer">
              <button type="submit" id="btn_save" name="btn_save" required class="btn btn-fill btn-primary">Update Product</button>
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