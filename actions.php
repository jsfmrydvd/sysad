<?php

include 'config.php';
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
          echo "<script>alert('Registration successful!');</script>";
          header ("location:index.php");
        }else{
          echo "<script>alert('Error in registration!');</script>";
        }
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
    if($pname!=""){
      $result = $mysqli->query('UPDATE products SET product_name ="'. $pname .'" WHERE item_id ='.$item_id);
      if($result) {
           header ("location:index.php");
      }
    }
    if($quantity!=""){
      $result = $mysqli->query('UPDATE products SET quantity ="'. $quantity .'" WHERE item_id ='.$item_id);
      if($result) {
           header ("location:index.php");
      }
    }
    if($price!=""){
      $result = $mysqli->query('UPDATE products SET price ="'. $price .'" WHERE item_id ='.$item_id);
      if($result) {
           header ("location:index.php");
      }
    }
}

?>
