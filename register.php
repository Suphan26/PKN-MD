<?php
$host = "localhost";
$db_user = "admin";
$db_pass = "admin";
$db_name = "login_system";

// เชื่อมต่อฐานข้อมูล
$conn = new mysqli($host, $db_user, $db_pass, $db_name);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = ""; // เก็บข้อความแจ้งเตือน

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $number = trim($_POST['number']);
    $date = trim($_POST['date']);

    // ตรวจสอบว่าชื่อผู้ใช้ซ้ำหรือไม่
    $sql_check = "SELECT * FROM users WHERE username = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("s", $username);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        $message = "ชื่อผู้ใช้นี้ถูกใช้แล้ว!";
    } else {
        // บันทึกข้อมูลผู้ใช้ใหม่โดยไม่เข้ารหัสรหัสผ่าน
        $sql_insert = "INSERT INTO users (username, password, number, date) VALUES (?, ?, ?, ?)";
        $stmt_insert = $conn->prepare($sql_insert);
        $stmt_insert->bind_param("ssss", $username, $password, $number, $date);
        if ($stmt_insert->execute()) {
            // ส่งข้อมูล username ไปหน้า login.php
            header("Location: login.php?username=" . urlencode($username));
            exit();
        } else {
            $message = "เกิดข้อผิดพลาดในการสมัครสมาชิก.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ลงทะเบียน</title>
    <link href="https://fonts.googleapis.com/css2?family=K2D:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'K2D', sans-serif;
            background: linear-gradient(to right, #0096b1, #0096b1);
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            box-sizing: border-box;
        }

        header {
            width: 100%;
            margin-bottom: 20px;
            text-align: center;
        }

        header img {
            width: 100%;
            max-width: 600px;
            height: auto;
            border-radius: 8px;
        }

        .login-container {
            background: #fff;
            padding: 30px 20px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
            color: #333;
        }

        .login-container h2 {
            margin-bottom: 20px;
            font-size: 26px;
            font-weight: 600;
            color: #0096b1;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .form-group label {
            font-weight: 600;
            margin-bottom: 8px;
            display: block;
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            margin-top: 8px;
            box-sizing: border-box;
        }

        .form-group input:focus {
            border-color: #0096b1;
            outline: none;
        }

        .error {
            color: #e74c3c;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .btn {
            display: block;
            width: 100%;
            background: #0096b1;
            color: #fff;
            border: none;
            padding: 14px;
            font-size: 18px;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s, transform 0.2s ease;
        }

        .btn:hover {
            background: #005f73;
            transform: translateY(-4px);
        }

        .register-btn {
            margin-top: 15px;
            display: block;
            background: #00b4d8;
            color: #fff;
            padding: 14px;
            font-size: 18px;
            border-radius: 8px;
            text-decoration: none;
            text-align: center;
            transition: background 0.3s, transform 0.2s ease;
        }

        .register-btn:hover {
            background: #0077b6;
            transform: translateY(-4px);
        }

        @media (max-width: 600px) {
            .login-container {
                padding: 20px;
            }

            .form-group input {
                font-size: 14px;
                padding: 10px;
            }

            .btn, .register-btn {
                font-size: 16px;
                padding: 12px;
            }
        }
    </style>
</head>
<body>
    <header>
        <img src="../images/Banner2.png" alt="PKN-MD eLEARNING">
    </header>
    <div class="login-container">
        <h2>ลงทะเบียน</h2>
        <?php if (!empty($message)) echo "<p class='error'>$message</p>"; ?>
        <form method="POST" action="">
            <div class="form-group">
                <label for="username">ชื่อผู้ใช้</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">รหัสบัตรประชาชน</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="number">เบอร์โทรศัพท์</label>
                <input type="text" id="number" name="number" required>
            </div>
            <div class="form-group">
                <label for="date">วันเกิด</label>
                <input type="date" id="date" name="date" required>
            </div>
            <button type="submit" class="btn">ลงทะเบียน</button>
        </form>
        <a href="login.php" class="register-btn">เข้าสู่ระบบ</a>
    </div>
</body>
</html>
