<?php 
if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    $targetFile = basename($_FILES['image']['name']);
    if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
        $imageInfo = getimagesize($targetFile);
        $imageType = $imageInfo['mime'];
        $imageData = base64_encode(file_get_contents($targetFile));
        $image = 'data:' . $imageType . ';base64,' . $imageData;
    }
}

$data = array(
    'type' => isset($_POST['type']) ? $_POST['type'] : null,
    'name' => isset($_POST['name']) ? $_POST['name'] : null,
    'purchase_price' => isset($_POST['purchase_price']) ? $_POST['purchase_price'] : null,
    'sale_price' => isset($_POST['sale_price']) ? $_POST['sale_price'] : null,
    'sku' => isset($_POST['sku']) ? $_POST['sku'] : null,
    'manufacturer' => isset($_POST['manufacturer']) ? $_POST['manufacturer'] : null,
    'upc' => isset($_POST['upc']) ? $_POST['upc'] : null,
    'ean' => isset($_POST['ean']) ? $_POST['ean'] : null,
    'weight' => isset($_POST['weight']) ? $_POST['weight'] : null,
    'brand' => isset($_POST['brand']) ? $_POST['brand'] : null,
    'qty' => isset($_POST['qty']) ? $_POST['qty'] : null,
    'isbn' => isset($_POST['isbn']) ? $_POST['isbn'] : null,
    'unit' => isset($_POST['unit']) ? $_POST['unit'] : null,
    'returnable' => isset($_POST['returnable']) ? $_POST['returnable'] : null,
    'length' => isset($_POST['length']) ? $_POST['length'] : null,
    'width' => isset($_POST['width']) ? $_POST['width'] : null,
    'height' => isset($_POST['height']) ? $_POST['height'] : null,
    'image' => isset($image) ? $image : null,
    'description' => isset($_POST['description']) ? $_POST['description'] : null,
);
$jsonData = json_encode($data);
$csrfToken = bin2hex(random_bytes(32));
$targetUrl = 'http://localhost/inventory/products/api/add';

$ch = curl_init($targetUrl);

curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'X-CSRF-TOKEN: ' . $csrfToken
));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
curl_close($ch);
$errors = json_decode($response, true);
session_start();
if (isset($errors['errors']) && !empty($errors['errors'])) {
    $_SESSION['form_errors'] = $errors['errors'];
} else {
    $_SESSION['success_message'] = 'Product Addedd successfully!';
}
header('Location: index.php');
exit;

?>