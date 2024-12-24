<?php
session_start();
session_unset(); // ล้างข้อมูล Session ทั้งหมด
session_destroy(); // ทำลาย Session
header("Content-Type: application/json"); // ส่ง JSON response
echo json_encode(["status" => "success", "message" => "Logged out successfully."]);
exit();
?>
