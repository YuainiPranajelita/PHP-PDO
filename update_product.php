<?php
  include ('conn.php');

  $status = '';
  $result = '';
  if ($_SERVER['REQUEST_METHOD'] === 'GET') {
      if (isset($_GET['id'])) {
          
          $productCode_update = $_GET['id'];
          $query = "SELECT * FROM products WHERE productCode = '$productCode_update'";

          $result = $conn->query($query);
      }
  }

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $productCode = $_POST['productCode'];
      $productName = $_POST['productName'];
      $productLine = $_POST['productLine'];
      $productScale = $_POST['productScale'];
      $productVendor = $_POST['productVendor'];
      $productDescription = $_POST['productDescription'];
      $quantityInStock = $_POST['quantityInStock'];
      $buyPrice = $_POST['buyPrice'];
      $MSRP = $_POST['MSRP'];
      
      $sql = "UPDATE products SET productName='$productName', productLine='$productLine', productScale='$productScale',productVendor='$productVendor',productDescription='$productDescription',quantityInStock='$quantityInStock', buyPrice='$buyPrice',MSRP='$MSRP' WHERE productCode='$productCode'";

      
      if ($conn->query($sql)) {
        $status = 'ok';
      }
      else{
        $status = 'error';
      }

    
      header('Location: product.php?status='.$status);
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP PDO Update Product</title>
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
                <h2 style="margin: 30px 0 30px;">Update Data Product</h2>
                <form action="updateProduct.php" method="post">
                    <?php while($data = $result->fetch(PDO::FETCH_ASSOC) ): ?>
                    <div>
                    <label>Product Code</label>
                    <input type="text" placeholder="> 497" value="<?= $data['productCode'] ?>" name="productCode" readonly>
                    </div>
                    <div>
                    <label>Product Name</label>
                    <input type="text" placeholder="Name..." value="<?= $data['productName'] ?>" name="productName" required="required">
                    </div>
                    <?php 
                        $queryLine = "SELECT productLine FROM productlines";
                        $resultLine = $conn->query($queryLine);
                    ?>
                    <div>
                    <label>Product Line</label>
                    <input type="text" placeholder="Last Name..." value="<?= $data['productLine'] ?>" name="productLine" required="required">
                    </div>
                    <div>
                    <label>Product Scale</label>
                    <select name="productLine" required="required">
                        <option value="">Pilih Salah Satu</option>
                        <?php while($dataLine = $resultLine->fetch(PDO::FETCH_ASSOC) ): ?>
                            <option value="<?= $dataLine['productLine'] ?>"<?= $dataLine['productLine'] == $data['ProductLine'] ? "selected" : "" ?>><?= $dataLine['productLine'] ?></option>
                        <?php endwhile; ?>
                    </select>
                    </div>
                    <div>
                    <label>Product Vendor</label>
                    <input type="text" placeholder="085*****9426" value="<?= $data['productVendor'] ?>" name="productVendor" required="required">
                    </div>
                    <div>
                    <label>Product Description</label>
                    <input type="text" placeholder="Jl Street..." value="<?= $data['productDescription'] ?>" name="productDescription" required="required">
                    </div>
                    <div>
                    <label>Quantity in Stock</label>
                    <input type="text" placeholder="Address Details" value="<?= $data['quantityInStock'] ?>" name="quantityInSTock" >
                    </div>
                    <div>
                    <label>Buy Price</label>
                    <input type="text" placeholder="Surabaya..." value="<?= $data['buyPrice'] ?>" name="buyPrice" required="required">
                    </div>
                    <div>
                    <label>MSRP</label>
                    <input type="text" placeholder="Jawa Timur..." value="<?= $data['MSRP'] ?>" name="MSRP">
                    </div>
                    <?php endwhile; ?>
                    <button type="submit">Save Changes</button>
                </form>
            </main>
        </div>
    </div>
</body>
</html>