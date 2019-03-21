<?php

include 'config.php';

$result = $mysqli->query("SELECT MONTHNAME(dbdate), year(dbdate), SUM(total_amount) FROM sysad.sales GROUP BY YEAR(dbdate), MONTH(dbdate)");
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
$sql=$mysqli->query("SELECT MONTHNAME(dbdate), year(dbdate), SUM(total_amount) FROM sysad.sales GROUP BY YEAR(dbdate), MONTH(dbdate) LIMIT $this_page_first_result , $results_per_page");
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
                    <a class="nav-item nav-link active" href="index.php">Home <span class="sr-only">(current)</span></a>
                    <!-- <a class="nav-item nav-link" href="#">Sales</a> -->
                    <a class="nav-item nav-link" href="totalSales.php">Sales</a>
                </div>
            </div>
        </nav>
    </header>
    <!-- <form action="index.php" method="post">
      <div class="col-md-4 text-center" style="display:flex; margin: auto; padding-top: 30px;">
        <input class="form-control" name="search" type="search" placeholder="Search..."autofocus>
        <input class="btn btn-primary" type="submit" name="button">
      </div>
    </form> -->
    <div class="table-content">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col" class=" th">Month</th>
                    <th scope="col" class=" th">Year</th>
                    <th scope="col" class=" th">Total Amount</th>
                    <!-- <th scope="col" class=" th" colspan="2">Actions</th> -->

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
                  echo '<td>' . $obj->{'MONTHNAME(dbdate)'} . '</td>';
                  echo '<td>' . $obj->{'year(dbdate)'} . '</td>';
                  echo '<td>₱' . $obj->{'SUM(total_amount)'} . '</td>';

                  // echo '<td colspan="1">' .'<button id="'.$obj->{'item_id'}.'" class="btn btn-primary add-record" style="display: block; margin: auto; text-align: center;" data-toggle="modal" data-target="#editItemModal" onClick="getId('.$obj->{'item_id'}.')">Edit</button>'. '</td>';
                  // echo '<td colspan="1">' .'<button id="'.$obj->{'item_id'}.'" class="btn btn-primary add-record" style="display: block; margin: auto; text-align: center;" data-toggle="modal" data-target="#deleteItemModal"  onClick="getId('.$obj->{'item_id'}.')">Delete</button>'. '</td>';
                  echo "</tr>";
                  echo "</tbody>";
              }
            }
            ?>
        </table>
        <?php
        for ($page=1;$page<=$number_of_pages;$page++) {
          echo '<a href="totalSalesPerMonth.php?page=' . $page . '">' . $page . '</a> ';
        }
        include 'scripts.php'
         ?>
    </div>
    <script>
    function getId(id) {
        console.log(id);
        var price = <?php echo $price ?>;
        var quantity = <?php echo $quantity ?>;
        document.getElementById('item_id_edit').value = id;
        document.getElementById('item_id_delete').value = id;
        // document.getElementById('pname_edit').value = pname;
        document.getElementById('quantity_edit').value = quantity;
        document.getElementById('price_edit').value = price;
    }
    </script>

</body>
</html>
