<?php

include 'config.php';
session_start();

$result = $mysqli->query('SELECT * FROM products ORDER BY `id`');
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


//get sql database
$sql=$mysqli->query("SELECT * from products ORDER BY `id` LIMIT $this_page_first_result , $results_per_page");

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
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">SYSAD</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link active" href="#">Home <span class="sr-only">(current)</span></a>
                    <a class="nav-item nav-link" href="totalSalesPerMonth.php">Sales per month</a>
                    <a class="nav-item nav-link" href="totalSales.php">Sales</a>
                </div>
            </div>
        </nav>
    </header>
    <form action="index.php" method="post">
      <div class="col-md-4 text-center" style="display:flex; margin: auto; padding-top: 30px;">
        <input class="form-control" name="search" type="search" placeholder="Search..."autofocus>
        <input class="btn btn-primary" type="submit" name="button">
      </div>
    </form>
    <div class="table-content">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col" class=" th">Item Id</th>
                    <th scope="col" class=" th">Product Name</th>
                    <th scope="col" class=" th">Quantity</th>
                    <th scope="col" class=" th">Price</th>
                    <th scope="col" class=" th" colspan="2">Actions</th>

                </tr>
            </thead>
            <?php
            include 'addItemModal.php';
            include 'editItemModal.php';
            include 'deleteItemModal.php';
            include 'registerSaleModal.php';


            if($sql){
              while($obj = $sql->fetch_object()) {
                  $id =  $obj->{'item_id'};
                  // $pname = $obj->{'product_name'};
                  $quantity = $obj->{'quantity'};
                  $price = $obj->{'price'};
                  echo "<tbody>";
                  echo "<tr>";
                  echo '<td>' . $obj->{'item_id'} . '</td>';
                  echo '<td>' . $obj->{'product_name'} . '</td>';
                  echo '<td>' . $obj->{'quantity'} . '</td>';
                  echo '<td>₱' . $obj->{'price'} . '</td>';
                  echo '<td colspan="1">' .'<button id="'.$obj->{'item_id'}.'" class="btn btn-primary add-record" style="display: block; margin: auto; text-align: center;" data-toggle="modal" data-target="#editItemModal" onClick="getId('.$obj->{'item_id'}.')">Edit</button>'. '</td>';
                  echo '<td colspan="1">' .'<button id="'.$obj->{'item_id'}.'" class="btn btn-primary add-record" style="display: block; margin: auto; text-align: center;" data-toggle="modal" data-target="#deleteItemModal"  onClick="getId('.$obj->{'item_id'}.')">Delete</button>'. '</td>';
                  echo "</tr>";
                  echo "</tbody>";
                  // display the links to the pages
              }
              for ($page=1;$page<=$number_of_pages;$page++) {
                echo '<a href="index.php?page=' . $page . '">' . $page . '</a> ';
              }
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
        echo '<button class="btn btn-success add-record" style="margin: 10px;" data-toggle="modal" data-target="#addItemModal">Add item</button>';
        echo '<button class="btn btn-success add-record" style="margin: 10px;" data-toggle="modal" data-target="#registerSale">Register Sale</button>';
        echo '</div>';
        include 'scripts.php'
         ?>
    </div>
    <script>
    function getId(id) {
        console.log(id);

        document.getElementById('item_id_edit').value = id;
        document.getElementById('item_id_delete').value = id;
        // document.getElementById('pname_edit').value = pname;
        document.getElementById('quantity_edit').value = quantity;
        document.getElementById('price_edit').value = price;
    }
    </script>

</body>
</html>
