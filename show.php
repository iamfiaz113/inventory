<?php 
if (isset($_GET['id'])) {
    $productId = $_GET['id'];
    $ch = curl_init();
    $url = 'http://localhost/inventory/products/api/show/'.$productId;
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch); 
    $responseArray = json_decode($response, true);
    session_start();
    if (isset($responseArray['error'])) {
        $_SESSION['errors'] = $responseArray['error'];
        header("Location: view.php");
    }else{
        $_SESSION['show'] = isset($responseArray['show']) ? $responseArray['show'] : null;
        header("Location: edit.php");
    }
}else{
    header("Location: view.php");
    exit;
}
?>