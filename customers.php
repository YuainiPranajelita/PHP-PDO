<?php
    include('conn.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP PDO Yuaini</title>
</head>
<body>

    <div>
        <div>
            <nav>
                <div>
                    <ul>
                        <li>
                            <a href="customers.php">Data Customers</a>
                        </li>
                        <li>
                            <a href="product.php">Data Product</a>
                        </li>
                        <li>
                            <a href="tambahdata_customers.php">Tambah Data Customers</a>
                        </li>
                        <li>
                            <a href="tambahdata_product.php">Tambah Data Product</a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main role="main">
                <?php
                    if(@$_GET['status'] !== null) {
                        $status = $_GET ['status'];
                        if ($status == 'ok') {
                            echo '<br><br><div role = "alert"> Data Customers Berhasil di Update </div>';
                        } else if ($status == 'error') {
                            echo '<br><br><div role = "alert"> Data Customers Gagal di Update </div>';
                        }
                    }
                ?>

                <h2 style="margin: 30px 0 30px; font-size: 50px; text-align: center;">Customers</h2>
                <div>
                    <table border="1">
                        <thead>
                            <tr>
                                <th>Customer No.</th>
                                <th>Name</th>
                                <th>Contact Last Name</th>
                                <th>Contact First Name</th>
                                <th>Phone</th>
                                <th>Address 1</th>
                                <th>Address 2</th>
                                <th>City</th>
                                <th>State</th>
                                <th>Postal Code</th>
                                <th>Country</th>
                                <th>SalesRepEmployeeNumber</th>
                                <th>Credit Limit</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                                $query = "SELECT * FROM customers";
                                $result = $conn->query($query);
                            ?>

                            <?php while($data = $result->fetch(PDO::FETCH_ASSOC) ): ?>
                            <tr>
                                <td><?php echo $data['customerNumber']; ?></td>
                                <td><?php echo $data['customerName']; ?></td>
                                <td><?php echo $data['contactLastName']; ?></td>
                                <td><?php echo $data['contactFirstName']; ?></td>
                                <td><?php echo $data['phone']; ?></td>
                                <td><?php echo $data['addressLine1']; ?></td>
                                <td><?php echo $data['addressLine2']; ?></td>
                                <td><?php echo $data['city']; ?></td>
                                <td><?php echo $data['state']; ?></td>
                                <td><?php echo $data['postalCode']; ?></td>
                                <td><?php echo $data['country']; ?></td>
                                <td><?php echo $data['salesRepEmployeeNumber']; ?></td>
                                <td><?php echo $data['creditLimit']; ?></td>
                                <td>
                                    <a href="<?php echo "update.php?id=".$data['customerNumber']; ?>"> Update</a>
                                    &nbsp;&nbsp;
                                    <a href="<?php echo "delete.php?id=".$data['customerNumber']; ?>"> Delete</a>
                                </td>
                            </tr>
                            <?php endwhile; ?>

                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>
</body>
</html>