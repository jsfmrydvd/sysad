<?php
include 'config.php';
session_start();
$var="id";
$result = $mysqli->query('SELECT * FROM sales ORDER BY `idsales`');

// define how many results you want per page
$results_per_page = 10;
$number_of_results = mysqli_num_rows($result);
$number_of_pages = ceil($number_of_results/$results_per_page);
if (!isset($_GET['page'])) {
  $page = 1;
} else {
  $page = $_GET['page'];
}

$this_page_first_result = ($page-1)*$results_per_page;

//get sql database
$sql=$mysqli->query("SELECT * from sales ORDER BY `idsales` LIMIT $this_page_first_result , $results_per_page");

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
     include('active.php');
      ?>
      <!-- sidebar-wrapper  -->
      <main class="page-content">
        <div class="container-fluid" style="background: #eee; min-height: 100vh;">

          <h5 class="title-heading">Sales</h5>
          <div class="table-content">
              <table class="table">
                  <thead>
                      <tr>
                          <th scope="col" class=" th">Date</th>
                          <th scope="col" class=" th">Item Id</th>
                          <th scope="col" class=" th">Product Name</th>
                          <th scope="col" class=" th">Quantity Sold</th>
                          <th scope="col" class=" th">Total Cost</th>
                          <th scope="col" class=" th">Total Sale</th>
                           <th scope="col" class=" th">Total Income</th>
                      </tr>
                  </thead>
                  <?php
                  include 'addItemModal.php';
                  include 'editItemModal.php';
                  include 'deleteItemModal.php';
                  include 'registerSaleModal.php';

                  if($sql){
                    while($obj = $sql->fetch_object()) {
                        echo "<tbody>";
                        echo "<tr>";
                        echo '<td>' . $obj->{'dbdate'} . '</td>';
                        echo '<td>' . $obj->{'item_id'} . '</td>';
                        echo '<td>' . $obj->{'product_name'} . '</td>';
                        echo '<td>' . $obj->{'quantity_sold'} . '</td>';
                        echo '<td>₱' . $obj->{'total_cost'} . '</td>';
                        echo '<td>₱' . $obj->{'total_amount'} . '</td>';
                        echo '<td>₱' . $obj->{'total_profit'} . '</td>';
                        echo "</tr>";
                        echo "</tbody>";
                    }

                  echo "<div class='pagination'>";
                  if($page == 1) {
                      echo ' <a class="prev" href="totalSales.php?page=' . ($page). '"">Prev</a>';
                  } else {
                      echo ' <a class="prev" href="totalSales.php?page=' . ($page-1). '"">Prev</a>';

                  }
                  for ($i=1;$i<=$number_of_pages;$i++) {
                      $act = "active";
                      if($i == $page) {
                          echo '<a class="'.$act.'" totalSales="index.php?page=' . $i . '">' . $i . '</a> ';
                      } else {
                          echo '<a class="" href="totalSales.php?page=' . $i . '">' . $i . '</a> ';
                      }
                } if($number_of_pages == $page) {
                    echo '<a class="next" href="totalSales.php?page=' . ($page). '"">Next</a>';
                } else {
                    echo '<a class="next" href="totalSales.php?page=' . ($page+1). '"">Next</a>';
                }
                  echo "</div>";
              }
                  ?>
              </table>
              <?php
              include 'scripts.php'
               ?>
          </div>

        </div>
      </main>
    </div>
</body>
</html>
