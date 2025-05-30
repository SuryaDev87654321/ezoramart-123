<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
use Razorpay\Api\Api;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Import Razorpay SDK (via composer recommended, or manually)
    require('razorpay-php/Razorpay.php');
    

    $keyId = 'rzp_test_ubUZykSMO37A8O';
    $keySecret = 'DCgpThXcvW3KVdmx8ErAIXzs';

    $api = new Api($keyId, $keySecret);

    $payment_id = $_POST['razorpay_payment_id'];

    try {
        $payment = $api->payment->fetch($payment_id);
        if ($payment->status == 'authorized' || $payment->status == 'captured') {
            echo "<h2>Payment Successful!</h2>";
            echo "Payment ID: " . $payment->id;
        } else {
            echo "<h2>Payment Failed!</h2>";
        }
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
} else {
    echo "Invalid Request";
}
?>
