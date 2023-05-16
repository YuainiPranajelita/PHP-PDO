<?php 

  include ('conn.php'); 

  $status = '';
  $result = '';
  
  if ($_SERVER['REQUEST_METHOD'] === 'GET') {
      if (isset($_GET['id'])) {
          
          $customerNumber = $_GET['id'];
          $query = $conn->prepare("DELETE FROM customers WHERE customerNumber = :customerNumber ");
          
          $query->bindParam(':customerNumber',$customerNumber);
          
          if ($query->execute()) {
            $status = 'ok';
          }
          else{
            $status = 'error';
          }

          header('Location: customers.php?status='.$status);
      }  
  }
?>