<?php

$payment = $_GET['payment_id'];
$status = $_GET['status'];
$type = $_GET['payment_type'];
$order_id = $_GET['merchant_order_id'];

echo "<h3>EL PAGO FUE EXITOSO !</h3>";

echo $payment."<br>";
echo $status."<br>";
echo $type."<br>";
echo $order_id."<br>";