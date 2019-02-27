<?php

include 'config.php';
$var="id";
$result = $mysqli->query('SELECT * FROM products ORDER BY `id`');

if(isset($_POST['button'])){
  $search=$_POST['search'];
  $result=$mysqli->query("SELECT * from products where (`id` LIKE '%".$search."%') OR (`product_name` LIKE '%".$search."%')");
}

if($result === FALSE){
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
                    <a class="nav-item nav-link" href="#">Sales</a>
                    <a class="nav-item nav-link" href="totalSales.php">Calendar</a>
                </div>
            </div>
        </nav>
    </header>
    <form action="index.php" method="post">
      <div class="col-md-4 text-center" style="display:flex; margin: auto;">
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

            if($result){
              while($obj = $result->fetch_object()) {
                  $id =  $obj->{'item_id'};
                  $pname = $obj->{'product_name'};
                  echo "<tbody>";
                  echo "<tr>";
                  echo '<td>' . $obj->{'item_id'} . '</td>';
                  echo '<td>' . $obj->{'product_name'} . '</td>';
                  echo '<td>' . $obj->{'quantity'} . '</td>';
                  echo '<td>$' . $obj->{'price'} . '</td>';
                  echo '<td colspan="1">' .'<button id="'.$obj->{'item_id'}.'" class="btn btn-primary add-record" style="display: block; margin: auto; text-align: center;" data-toggle="modal" data-target="#editItemModal" onClick="getId('.$obj->{'item_id'}.')">Edit</button>'. '</td>';
                  echo '<td colspan="1">' .'<button class="btn btn-primary add-record" style="display: block; margin: auto; text-align: center;" data-toggle="modal" data-target="#deleteItemModal">Delete</button></button>'. '</td>';
                  echo "</tr>";
                  echo "</tbody>";
              }
            }
            ?>
        </table>
        <?php
        echo '<button class="btn btn-success add-record" style="display: block; margin: auto; text-align: center;" data-toggle="modal" data-target="#addItemModal">Add item</button>';
        include 'scripts.php'
         ?>
    </div>
    <script>
        

    </script>
</body>
</html>
