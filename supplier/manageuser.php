<?php
session_start();
include("./includes/db.php");

if (isset($_GET['action']) && $_GET['action'] != "" && $_GET['action'] == 'delete') {
  $user_id = $_GET['user_id'];

  /* This is delete query */
  mysqli_query($con, "DELETE FROM user_info WHERE user_id='$user_id'") or die("Query is incorrect...");
}

include "sidenav.php";
include "topheader.php";
?>
<!-- End Navbar -->
<div class="content">
  <div class="container-fluid">
    <div class="col-md-14">
      <div class="card">
        <div class="card-header card-header-primary">
          <h4 class="card-title">Manage User</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive ps">
            <table class="table tablesorter table-hover">
              <thead class="text-primary">
                <tr>
                  <th>User ID</th>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Email</th>
                  <th>Mobile</th>
                  <th>Address 1</th>
                  <th>Address 2</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $result = mysqli_query($con, "SELECT user_id, first_name, last_name, email, mobile, address1, address2 FROM user_info") or die("Query is incorrect...");

                while (list($user_id, $first_name, $last_name, $email, $mobile, $address1, $address2) = mysqli_fetch_array($result)) {
                  echo "<tr>
                                            <td>$user_id</td>
                                            <td>$first_name</td>
                                            <td>$last_name</td>
                                            <td>$email</td>
                                            <td>$mobile</td>
                                            <td>$address1</td>
                                            <td>$address2</td>
                                            <td>
                                                <a class='btn btn-danger' href='manageuser.php?user_id=$user_id&action=delete'>Delete<div class='ripple-container'></div></a>
                                            </td>
                                          </tr>";
                }
                mysqli_close($con);
                ?>
              </tbody>
            </table>
            <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
              <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
            </div>
            <div class="ps__rail-y" style="top: 0px; right: 0px;">
              <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
include "footer.php";
?>