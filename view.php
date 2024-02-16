<?php
  $targetUrl = 'http://localhost/inventory/products/api/get';
  $jsonData = file_get_contents($targetUrl);
  $data = json_decode($jsonData, true);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <title>inventory Sotre</title>
</head>
<body>

<div class="container mt-5">
  <?php
   session_start();
   if (isset($_SESSION['errors']) && !empty($_SESSION['errors'])) {
    echo '<div class="alert alert-danger">';
    echo $_SESSION['errors'];
    echo '</div>';
    unset($_SESSION['errors']);
  }
   if (isset($_SESSION['success']) && !empty($_SESSION['success'])) {
       echo '<div class="alert alert-success">';
       echo $_SESSION['success'];
       echo '</div>';
       unset($_SESSION['success']);
   }
   ?>
  <h2 class="mb-4">Products</h2>
  <h2 class="mb-4 text-right">
    <a class="btn btn-primary" href="index.php">+Add</a>
  </h2>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>ID</th>
        <th>Image</th>
        <th>Name</th>
        <th>Type</th>
        <th>SKU</th>
        <th>Manufacturer</th>
        <th>Qty</th>
        <th>Purchase Price</th>
        <th>Sale Price</th>
        <th>Action</th> 
      </tr>
    </thead>
    <tbody>
      <?php
        foreach ($data as $item) {
          echo '<tr>
                  <td>' . $item['id'] . '</td>
                  <td class="p-0"><img src="' . $item['image'] . '" alt="Product Image" class="rounded w-100" style="width:100px;height:100px"></td>
                  <td>' . $item['name'] . '</td>
                  <td>' . $item['type'] . '</td>
                  <td>' . $item['sku'] . '</td>
                  <td>' . $item['manufacturer'] . '</td>
                  <td>' . $item['qty'] . '</td>
                  <td>' . $item['purchase_price'] . '</td>
                  <td>' . $item['sale_price'] . '</td>
                  <td>
                  <a href="show.php?id=' . $item['id'] . '" class="btn btn-primary btn-sm">Edit</a>
                  <a href="delete_product.php?id=' . $item['id'] . '" class="btn btn-danger btn-sm">Delete</a>
                  </td>
                </tr>';
        }
      ?>
    </tbody>
  </table>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>

</body>
</html>
