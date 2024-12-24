<?php
session_start();

// ตรวจสอบว่าเซสชันถูกกำหนดไว้หรือยัง
if (!isset($_SESSION['username'])) {
    // ถ้ายังไม่ได้เข้าสู่ระบบ ให้เปลี่ยนเส้นทางไปยังหน้า login.php
    header("Location: login.php");
    exit;
}
?>

<!doctype html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Website</title>
    <!-- ใช้ Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            background: linear-gradient(135deg, #0096b1, #0096b1);
            background-size: cover; /* ให้ครอบคลุมเต็มหน้าจอ */
            background-repeat: no-repeat; /* ไม่ทำซ้ำ */
            background-attachment: fixed; /* พื้นหลังอยู่กับที่ */
            min-height: 100vh; /* ให้ความสูงของพื้นหลังครอบคลุมทั้งหน้าจอ */
        }
        .welcome-banner {
            background-color: #0b505d;
            color: #fff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 30px;
            border-radius: 8px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }
        .welcome-banner h1 {
            margin: 0;
            font-size: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .welcome-banner .icon-user {
            background-color: #fff;
            color: #4A90E2;
            border-radius: 50%;
            padding: 5px;
            font-size: 18px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        .shutdown-btn {
            background-color: #FF5757; /* สีแดง */
            color: #fff; /* ตัวอักษรสีขาว */
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .shutdown-btn:hover {
            background-color: #FF3030; /* สีแดงเข้มเมื่อ hover */
            transform: scale(1.05); /* ขยายเล็กน้อย */
        }
        .shutdown-btn .icon {
            font-size: 20px;
        }
        .image-grid {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
        }
        .image-grid img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }
        .image-grid img:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Welcome Banner -->
        <div class="welcome-banner">
            <h1>
                <span class="icon-user">&#128100;</span> <!-- ไอคอนผู้ใช้ -->
                <?php echo htmlspecialchars($_SESSION['username']); ?>
            </h1>
            <!-- ปุ่ม Shutdown -->
            <button class="shutdown-btn" onclick="shutdown()">
                <span class="icon">&#x23FB;</span> Logout
            </button>
        </div>

        <!-- Images -->
        <div class="image-grid mt-4">
            <a href="Renew.php">
                <img src="../images/Renew-eng.png" alt="Renew">
            </a>
            <a href="Retake.php">
                <img src="../images/Retake-eng.png" alt="Retake">
            </a>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function shutdown() {
            if (confirm("คุณต้องการปิดระบบหรือไม่?")) {
                // ใช้ fetch เพื่อเรียกไปยัง logout.php
                fetch('logout.php', {
                    method: 'POST'
                }).then(() => {
                    window.location.href = "foreign.php"; // เปลี่ยนเส้นทาง
                }).catch((error) => {
                    alert("เกิดข้อผิดพลาด: " + error.message);
                });
            }
        }
    </script>
</body>
</html>
