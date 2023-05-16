<?php 

  include ('conn.php'); 

  $status = '';
  $result = '';
  
  if ($_SERVER['REQUEST_METHOD'] === 'GET') {
      if (isset($_GET['id'])) {
          
          $productCode = $_GET['id'];
          $query = $conn->prepare("DELETE FROM products WHERE productCode = :productCode ");
        
          $query->bindParam(':productCode',$productCode);
          
          if ($query->execute()) {
            $status = 'ok';
          }
          else{
            $status = 'error';
          }

          header('Location: product.php?status='.$status);
      }  
  }