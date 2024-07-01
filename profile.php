<?php
session_start();
include("connect.php");

// التحقق من أن user_id متاح في الجلسة أو في طلب GET
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} elseif (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
} else {
    die("User ID not defined.");
}

// استعلام لاسترداد معلومات المستخدم
$user_sql = "SELECT username FROM users WHERE id = '$user_id'";
$user_result = mysqli_query($conn, $user_sql);
$user_data = mysqli_fetch_assoc($user_result);

// استعلام لاسترداد منتجات المستخدم
$sql = "SELECT * FROM products WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $sql);

echo "<!DOCTYPE html>
<html lang='ar'>
<head>
    <meta charset='UTF-8'>
    <title>منتجاتي</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
            margin: 0;
        }
        header {
            background-color: #333;
            color: #fff;
            padding: 15px 20px;
            text-align: center;
            position: fixed;
            width: 100%;
            top: 0;
            left: 0;
            z-index: 1000;
        }
        header a {
            color: #007bff;
            text-decoration: none;
            padding: 5px 10px;
            background-color: #fff;
            border-radius: 5px;
            margin-top: 10px;
            display: inline-block;
        }
        header a:hover {
            text-decoration: underline;
        }
        main {
            margin-top: 100px; /* ارتفاع الرأس */
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        img {
            max-width: 100px;
            max-height: 100px;
        }
        a {
            text-decoration: none;
            color: #007bff;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <header>
        <h1>منتجاتي</h1>
        <p>مرحبا، " . $user_data['username'] . "</p>
        <a href='view_orders.php?user_id=" . $user_id . "'>عرض الطلبات</a>
        <a href='your orders.php?user_id=" . $user_id . "'>عرض </a>

    </header>
    <main>";

if (mysqli_num_rows($result) > 0) {
    echo "<table>
            <tr>
                <th>الرقم التعريفي</th>
                <th>اسم المنتج</th>
                <th>الصورة</th>
                <th>الوصف</th>
                <th>السعر</th>
                <th>تعديل</th>
                <th>حذف</th>
                
            </tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td><img src='" . $row['image'] . "' alt='" . $row['name'] . "'></td>";
        echo "<td>" . $row['descrip'] . "</td>";
        echo "<td>" . $row['price'] . "</td>";
        echo "<td><a href='edit_product.php?product_id=" . $row['id'] . "'>تعديل</a></td>";
        echo "<td><a href='delete_product.php?product_id=" . $row['id'] . "'>حذف</a></td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "<p>لا توجد منتجات</p>";
}

echo "</main>
</body>
</html>";

// إغلاق الاتصال
mysqli_close($conn);
?>
