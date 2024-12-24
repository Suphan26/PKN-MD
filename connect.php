<?php
// กำหนดค่าเชื่อมต่อฐานข้อมูล
$servername = "localhost";  // ชื่อโฮสต์ (สำหรับ XAMPP ใช้ localhost)
$username = "admin";        // ชื่อผู้ใช้ (ชื่อผู้ใช้เริ่มต้นของ XAMPP คือ root)
$password = "admin";            // รหัสผ่าน (เริ่มต้นจะเป็นค่าว่าง)
$dbname = "testing_database";        // ชื่อฐานข้อมูลที่สร้างขึ้น

// สร้างการเชื่อมต่อ
$conn = new mysqli($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully"; // แสดงข้อความเมื่อเชื่อมต่อสำเร็จ

// ปิดการเชื่อมต่อหลังจากเสร็จสิ้น
$conn->close();
?>


<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Connecting</title>
</head>

<body>
</body>
</html>