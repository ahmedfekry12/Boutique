<?php
session_start();


include_once "../admin/functions/connection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');

    $productId = $_POST['id'];
    $action = $_POST['action'];
    $userId = $_SESSION['user_id'];
    $total = 0 ;
    $subtotal = 0 ;
    // استرجاع الكمية الحالية
    $query = $conn->query("SELECT * FROM cart WHERE user_id = $userId AND pro_id = $productId");
    $item = $query->fetch_assoc();
    
    if ($item) {
        $newQuantity = $item['quantities'];
        // echo $newQuantity;
        
        // زيادة أو نقصان الكمية
        if ($action === 'increment') {
            $newQuantity++;
        } elseif ($action === 'decrement' && $newQuantity > 1) {
            $newQuantity--;
        }

         // تحديث الكمية في قاعدة البيانات
         $update = $conn->query("UPDATE cart SET quantities = $newQuantity
         WHERE user_id = $userId AND pro_id = $productId");

         // جلب سعر المنتج
         $selectPro = $conn->query("SELECT * FROM products WHERE id = $productId");
         $row = $selectPro->fetch_assoc();

        // حساب الإجمالي الجديد للمنتج والإجمالي الكلي
        $subtotal = $newQuantity * $row['price'];

        $cartItems = $conn->query("SELECT cart.quantities, products.price FROM cart JOIN products ON cart.pro_id = products.id WHERE user_id = $userId");
            while ($cartItem = $cartItems->fetch_assoc()) {
                $total += $cartItem['quantities'] * $cartItem['price'];
            }

        // إرسال الرد
        echo json_encode([
            'status' => 'success',
            'newQuantity' => $newQuantity,
            'subtotal' => $subtotal,
            'total' => $total
        ]);
    } else {
        // echo "sdffsdf";
        echo json_encode(['status' => 'error', 'message' => 'Product not found.']);
    }
}
?>
