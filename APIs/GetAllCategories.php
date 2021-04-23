<?php
  include("../APIs/include/dbConnection.php");
  $query = "SELECT * FROM categories";
  $result = mysqli_query($conn, $query);
  $output = '';

  while($row = mysqli_fetch_array($result)) {
    $output .= '<option value="'.$row["category_id"].'">'.$row["category_name"].'</option>';
  }
?>