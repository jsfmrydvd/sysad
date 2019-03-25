<?php

include 'config.php';
session_start();

$result = $mysqli->query('SELECT * FROM products ORDER BY `item_id`');
// define how many results you want per page
$results_per_page = 7;
$number_of_results = mysqli_num_rows($result);
$number_of_pages = ceil($number_of_results/$results_per_page);
if (!isset($_GET['page'])) {
  $page = 1;
} else {
  $page = $_GET['page'];
}

$this_page_first_result = ($page-1)*$results_per_page;


//get sql database
$sql=$mysqli->query("SELECT * from products ORDER BY `item_id` LIMIT $this_page_first_result , $results_per_page");

if(isset($_POST['button'])){
  $search=$_POST['search'];
  $result = $mysqli->query("SELECT * from products where (`item_id` LIKE '%".$search."%') OR (`product_name` LIKE '%".$search."%')");
  // define how many results you want per page
  $results_per_page = 5;
  $number_of_results = mysqli_num_rows($result);
  $number_of_pages = ceil($number_of_results/$results_per_page);
  if (!isset($_GET['page'])) {
    $page = 1;
  } else {
    $page = $_GET['page'];
  }

  $this_page_first_result = ($page-1)*$results_per_page;


  $sql=$mysqli->query("SELECT * from products where (`item_id` LIKE '%".$search."%') OR (`product_name` LIKE '%".$search."%') LIMIT  $this_page_first_result, $results_per_page");
}

if($sql === FALSE){
  die(mysql_error());
}

 ?>
<!DOCTYPE html>
<html>
<?php
include 'header.php';
 ?>
<body>
    <div class="page-wrapper chiller-theme toggled">
      <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
        <i class="fas fa-bars"></i>
      </a>
     <?php
     include('navbar.php');
      ?>
      <!-- sidebar-wrapper  -->
      <main class="page-content">
        <div class="container-fluid" style="background: #eee; min-height: 100vh;">

          <h5 class="title-heading">Inventory</h5>
          <div class="table-content">
              <table class="table" cellpadding="10" width="400">
                  <thead>
                      <tr>
                          <th scope="col" class=" th">Item Id</th>
                          <th scope="col" class=" th">Product Name</th>
                          <th scope="col" class=" th">Quantity</th>
                          <th scope="col" class=" th">Cost</th>
                          <th scope="col" class=" th">Price</th>
                          <th scope="col" class=" th" colspan="2">Actions</th>

                      </tr>
                  </thead>
                  <?php
                  include 'addItemModal.php';
                  include 'editItemModal.php';
                  include 'deleteItemModal.php';
                  include 'registerSaleModal.php';
                  include 'returnModal.php';
                // $current_id;
                  if($sql){
                    while($obj = $sql->fetch_object()) {
                        $id =  $obj->{'item_id'};
                        echo "<tbody>";
                        echo "<tr>";
                        echo '<td>' . $obj->{'item_id'} . '</td>';
                        echo '<td>' . $obj->{'product_name'} . '</td>';
                        echo '<td>' . $obj->{'quantity'} . '</td>';
                        echo '<td>₱' . $obj->{'cost'} . '</td>';
                        echo '<td>₱' . $obj->{'price'} . '</td>';
                        echo '<td colspan="1">' .'<button id="'.$obj->{'item_id'}.'" class="btn btn-primary add-record" style="display: block; margin: auto; text-align: center;" data-toggle="modal" data-target="#editItemModal" onClick="getId('.$obj->{'item_id'}.')"><i class="fas fa-edit"></i>

</button>'. '</td>';
                        echo '<td colspan="1">' .'<button id="'.$obj->{'item_id'}.'" class="btn btn-danger add-record" style="display: block; margin: auto; text-align: center;" data-toggle="modal" data-target="#deleteItemModal"  onClick="getId('.$obj->{'item_id'}.')"><i class="fas fa-trash-alt"></i>

</button>'. '</td>';

                        echo "</tr>";
                        echo "</tbody>";
                    // display the links to the pages
                    }
                    echo "<div class='pagination'>";
                    if($page == 1) {
                        echo ' <a class="prev" href="index.php?page=' . ($page). '"">Prev</a>';
                    } else {
                        echo ' <a class="prev" href="index.php?page=' . ($page-1). '"">Prev</a>';
                    }
                    for ($i=1;$i<=$number_of_pages;$i++) {
                    $act = "active";
                    if($i == $page) {
                        echo '<a class="'.$act.'" href="index.php?page=' . $i . '">' . $i . '</a> ';
                    } else {
                        echo '<a class="" href="index.php?page=' . $i . '">' . $i . '</a> ';
                    }
                        } if($number_of_pages == $page) {
                      echo '<a class="next" href="index.php?page=' . ($page). '"">Next</a>';
                        } else {
                      echo '<a class="next" href="index.php?page=' . ($page+1). '"">Next</a>';
                        }
                        echo "</div>";
                    }
                  ?>
              </table>
              <?php
                      if (!empty($_SESSION['success'])){
              ?>
                          <div class="alert" style="background: green;color: white;height: 50px;width: 50vh;display: block;margin: auto;">
                                  <?php    echo $_SESSION['success']; ?>
                          </div>
               <?php
                      unset($_SESSION['success']);
                      }
                      ?>
              <?php
                      if (!empty($_SESSION['error'])){
              ?>
                          <div class="alert" style="background: red;color: white;height: 50px;width: 50vh;display: block;margin: auto;">
                                  <?php    echo $_SESSION['error']; ?>
                          </div>
               <?php
                      unset($_SESSION['error']);
                      }
                      ?>
              <?php
              echo '<div style="display: block; margin: auto; text-align: center;">';
              echo '<button class="btn btn-primary add-sale" style="margin: 10px;" data-toggle="modal" data-target="#addItemModal">Add</button>';
              echo '<button class="btn btn-primary add-sale" style="margin: 10px;" data-toggle="modal" data-target="#registerSale">Register</button>';
              echo '<button class="btn btn-primary add-sale" style="margin: 10px;" data-toggle="modal" data-target="#returnSale">Return</button>';
              echo '</div>';
              include 'scripts.php'
               ?>
          </div>

        </div>
      </main>
    </div>
    <script>
    function getId(id) {
        document.getElementById('item_id_edit').value = id;
        var current_id = id;
        // document.getElementById('get_id').value = current_id;
        document.getElementById('item_id_delete').value = id;
    }
    </script>

</body>
</html>
