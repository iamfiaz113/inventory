<?php
if (isset($_GET['id'])) {
    $productId = $_GET['id'];
    $ch = curl_init();
    $url = 'http://localhost/inventory/products/api/delete/'.$productId; 
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    echo $response;
    curl_close($ch);
    session_start();
    
    $responseArray = json_decode($response, true); 
    if (isset($responseArray['error'])) {
        $_SESSION['errors'] = $responseArray['error'];
    } else {
        $_SESSION['success'] = isset($responseArray['success']) ? $responseArray['success'] : null;
    }
    header('Location: view.php');
    exit;
} else {
    header("Location: view.php");
    exit();
}
?>
