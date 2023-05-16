<?php
  include ('conn.php');

  $status = '';
  $result = '';

  if ($_SERVER['REQUEST_METHOD'] === 'GET') {
      if (isset($_GET['id'])) {
          //query SQL
          $customerNumber_update = $_GET['id'];
          $query = "SELECT * FROM customers WHERE customerNumber = $customerNumber_update";

          //eksekusi query
          $result = $conn->query($query);
      }
  }

  
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $customerNumber = $_POST['customerNumber'];
      $customerName = $_POST['customerName'];
      $contactLastName = $_POST['contactLastName'];
      $contactFirstName = $_POST['contactFirstName'];
      $phone = $_POST['phone'];
      $addressLine1 = $_POST['addressLine1'];
      $addressLine2 = $_POST['addressLine2'];
      $city = $_POST['city'];
      $state = $_POST['state'];
      $postalCode = $_POST['postalCode'];
      $country = $_POST['country'];
      $salesRepEmployeeNumber = $_POST['salesRepEmployeeNumber'];
      $creditLimit = $_POST['creditLimit'];
      
      $sql = "UPDATE customers SET customerName='$customerName', contactLastName='$contactLastName', contactFirstName='$contactFirstName', phone='$phone',addressLine1='$addressLine1',addressLine2='$addressLine2',city='$city',state='$state',postalCode='$postalCode',country='$country',salesRepEmployeeNumber='$salesRepEmployeeNumber',creditLimit='$creditLimit' WHERE customerNumber=$customerNumber";

      
      if ($conn->query($sql)) {
        $status = 'ok';
      }
      else{
        $status = 'error';
      }

      
      header('Location: index.php?status='.$status);
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP PDO Update Customers</title>
</head>
<body>

    <div>
        <div>
            <nav>
                <div>
                    <ul>
                        <li>
                            <a href="index.php">Data Customers</a>
                        </li>
                        <li>
                            <a href="product.php">Data Product</a>
                        </li>
                        <li>
                            <a href="form.php">Tambah Data Customers</a>
                        </li>
                        <li>
                            <a href="formProduct.php">Tambah Data Product</a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main role="main">
                <h2 style="margin: 30px 0 30px;">Update Data Customers</h2>
                <form action="update.php" method="post">
                    <?php while($data = $result->fetch(PDO::FETCH_ASSOC) ): ?>
                    <div>
                    <label>Customer Number</label>
                    <input type="text" class="form-control" placeholder="> 497" value="<?= $data['customerNumber'] ?>" name="customerNumber" readonly>
                    </div>
                    <div>
                    <label>Customer Name</label>
                    <input type="text" class="form-control" placeholder="Name..." value="<?= $data['customerName'] ?>" name="customerName" required="required">
                    </div>
                    <div>
                    <label>Contact Last Name</label>
                    <input type="text" class="form-control" placeholder="Last Name..." value="<?= $data['contactLastName'] ?>" name="contactLastName" required="required">
                    </div>
                    <div>
                    <label>Contact First Name</label>
                    <input type="text" class="form-control" placeholder="First Name..." value="<?= $data['contactFirstName'] ?>" name="contactFirstName" required="required">
                    </div>
                    <div>
                    <label>Phone</label>
                    <input type="text" class="form-control" placeholder="085*****9426" value="<?= $data['phone'] ?>" name="phone" required="required">
                    </div>
                    <div>
                    <label>Address Line 1</label>
                    <input type="text" class="form-control" placeholder="Jl Street..." value="<?= $data['addressLine1'] ?>" name="addressLine1" required="required">
                    </div>
                    <div>
                    <label>Address Line 2</label>
                    <input type="text" class="form-control" placeholder="Address Details" value="<?= $data['addressLine2'] ?>" name="addressLine2" >
                    </div>
                    <div>
                    <label>City</label>
                    <input type="text" class="form-control" placeholder="Surabaya..." value="<?= $data['city'] ?>" name="city" required="required">
                    </div>
                    <div>
                    <label>State</label>
                    <input type="text" class="form-control" placeholder="Jawa Timur..." value="<?= $data['state'] ?>" name="state">
                    </div>
                    <div>
                    <label>Postal Code</label>
                    <input type="text" class="form-control" placeholder="614..." value="<?= $data['postalCode'] ?>" name="postalCode" required="required">
                    </div>
                    <div>
                    <label>Country</label>
                    <input type="text" class="form-control" placeholder="Indonesia..." value="<?= $data['country'] ?>" name="country" required="required">
                    </div>

                    <?php
                        $querySalesRep = "SELECT employeeNumber FROM employees";
                        $resultSalesRep = $conn->query($querySalesRep);
                    ?>

                    <div>
                        <label>Sales Rep Employee Number</label>
                        <select name="salesRepEmployeeNumber" required>
                            <option value="">Pilih Salah Satu</option>
                            <?php while($dataSalesRep = $resultSalesRep->fetch(PDO::FETCH_ASSOC) ): ?>
                                <option value="<?= $dataSalesRep['employeeNumber'] ?>" <?= $dataSalesRep['employeeNumber'] == $data['salesRepEmployeeNumber'] ? "selected" :"" ?>><?= $dataSalesRep['employeeNumber'] ?></option>
                                <?php endwhile; ?>
                        </select>
                    </div>
                    <div>

                        <label>Credit Limit</label>
                        <input type="text" placeholder="100000....." value="<?= $data['creditLimit'] ?>" name="creditLimit" required="required">
                    </div>

                    <?php endwhile; ?>
                    <button type="submit">Save Changes</button>
                </form>
            </main>
        </div>
    </div>
</body>
</html>