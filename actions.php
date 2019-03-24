<?php
include 'config.php';
session_start();
if(isset($_POST['addItem'])) {

    $item_id = $_POST["itemid"];
    $pname = $_POST["pname"];
    $quantity = $_POST["quantity"];
    $price = $_POST["price"];

    $addItem = "INSERT INTO products (`item_id`, `product_name`, `quantity`, `price`) VALUES('$item_id', '$pname', '$quantity', '$price')";
    try{
      $result = mysqli_query($mysqli, $addItem);

      if($result){
        if(mysqli_affected_rows($mysqli)>0){
            $_SESSION['success'] = 'Item Added!';
            header('location:index.php');
            exit;
        }else{
            $_SESSION['error'] = 'Error adding item!';
            header('location:index.php');
            exit;
        }
      }else{
          $_SESSION['error'] = 'Item id is already taken!';
          header('location:index.php');
          exit;
      }
    }catch(Exception $ex){
        echo("error".$ex->getMessage());
      }
}
if(isset($_POST['editItem'])) {

    $item_id = $_POST["itemid"];
    $pname = $_POST["pname"];
    $quantity = $_POST["quantity"];
    $price = $_POST["price"];
    if($pname!="" && $quantity!=0 && $price!=0){
      $result = $mysqli->query('UPDATE products SET product_name ="'. $pname .'" WHERE item_id ='.$item_id);
      $result1 = $mysqli->query('UPDATE products SET quantity ="'. $quantity .'" WHERE item_id ='.$item_id);
      $result2 = $mysqli->query('UPDATE products SET price ="'. $price .'" WHERE item_id ='.$item_id);
      if($result && $result1 && $result2) {
          $_SESSION['success'] = 'Edit success!';
          header('location:index.php');
          exit;
      } else {
          $_SESSION['error'] = 'Database error!';
          header('location:index.php');
          exit;
      }
  } else {
      $_SESSION['error'] = 'Edit Error!';
      header('location:index.php');
      exit;
  }

}
//deleteItem
if(isset($_POST['deleteItem'])) {
    $item_id = $_POST["itemid"];
    $res = $mysqli->query("DELETE FROM products WHERE `item_id`=".$item_id);
    if($res) {
        $_SESSION['success'] = 'Product successfully deleted!';
        header('location:index.php');
        exit;
    }
}
//register Sale
if(isset($_POST['registerSale'])) {
//get item id and quantity
    $item_id = $_POST["itemid"];
    $getID = $mysqli->query("SELECT `item_id` FROM `products` WHERE (`item_id`='$item_id' )");

    if(mysqli_num_rows($getID)==1) {
        $qn =  $_POST["quantity"];
        $date = date('m/d/Y');
        $timestamp = date('Y-m-d H:i:s', strtotime($date));
        //get the quantity
        $getQuantity = $mysqli->query("SELECT quantity FROM products WHERE `item_id`=".$item_id);
        $getPrice = $mysqli->query("SELECT price FROM products WHERE `item_id`=".$item_id);
        $getPname = $mysqli->query("SELECT product_name FROM products WHERE `item_id`=".$item_id);
        echo "22";
        if($getPrice){
            echo "334";
           while($obj = $getPrice->fetch_object()) {
               $price = $obj->{'price'};

           }
       } else {
           echo "skadsa";
       }
        if($getPname){
           while($obj = $getPname->fetch_object()) {
               $pname = $obj->{'product_name'};
           }
        }
        if($getQuantity){
          while($obj = $getQuantity->fetch_object()) {
              $quantity = $obj->{'quantity'};
              if($qn > $quantity) {
                  $_SESSION['error'] = 'Invalid quantity!';
                  header('location:index.php');
                   exit;
              } else {
                  $new_quantity = $quantity - $qn;
                  $new_price = $price * $qn;
                  $new_pname = $pname;
                  $updateQuantity = $mysqli->query('UPDATE products SET quantity ="'. $new_quantity .'" WHERE item_id ='.$item_id);
                  if($updateQuantity) {
                       $addToSales = "INSERT INTO sales (`dbdate`, `item_id`, `product_name`, `quantity_sold`, `total_amount`) VALUES('$timestamp', '$item_id', '$new_pname', '$qn', '$new_price')";
                       try{
                         $result = mysqli_query($mysqli, $addToSales);
                         if($result){
                           if(mysqli_affected_rows($mysqli)>0){
                               $_SESSION['success'] = 'Registered product!';
                               header('location:index.php');
                               exit;
                           }else{
                               $_SESSION['error'] = 'Invalid!';
                               header('location:index.php');
                               exit;
                           }
                         }
                       }catch(Exception $ex){
                           echo("error".$ex->getMessage());
                         }
                  } else {
                      $_SESSION['error'] = 'Database error!';
                      header('location:index.php');
                      exit;
                  }
              }
          }
        }
    }else {
      $_SESSION['error'] = 'Item not in database!';
      header('location:index.php');
       exit;
    }
}


?>
