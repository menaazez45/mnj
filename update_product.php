<?php
session_start();
include("connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id'])) {
    $productId = $_POST['product_id'];
    $productName = $_POST['product_name'];
    $productDescrip = $_POST['product_descrip'];
    $productPrice = $_POST['product_price'];

    // التحقق من هوية المستخدم الحالي
    if (isset($_SESSION['user_id'])) {
        $userId = $_SESSION['user_id'];

        // التحقق من أن المنتج ينتمي إلى المستخدم الحالي
        $sql = "SELECT * FROM products WHERE id = $productId AND user_id = $userId";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 1) {
            // قم بتحديث بيانات المنتج
            $sqlUpdate = "UPDATE products SET name = '$productName', descrip = '$productDescrip', price = '$productPrice' WHERE id = $productId";

            if (mysqli_query($conn, $sqlUpdate)) {
                echo "<p>تم تحديث بيانات المنتج بنجاح.</p>";
            } else {
                echo "<p>حدث خطأ أثناء تحديث بيانات المنتج: " . mysqli_error($conn) . "</p>";
            }
        } else {
            echo "<p>لا يمكنك تحديث هذا المنتج، حيث أنه ليس منتجك.</p>";
        }
    } else {
        echo "<p>يجب تسجيل الدخول لتحديث المنتج.</p>";
    }

    mysqli_close($conn);
} else {
    echo "<p>طلب غير صحيح.</p>";
}
?>
