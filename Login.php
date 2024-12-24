<?php
session_start();

$host = "localhost";
$db_user = "admin";
$db_pass = "admin";
$db_name = "login_system";

// ตรวจสอบว่ามี username ถูกส่งมาหรือไม่
$prefill_username = isset($_GET['username']) ? $_GET['username'] : '';

if (isset($_SESSION['username'])) {
    // หากผู้ใช้ล็อกอินอยู่แล้ว ให้ย้ายไปหน้า dashboard
    header("Location: index.php");
    exit();
}

// เชื่อมต่อฐานข้อมูล
$conn = new mysqli($host, $db_user, $db_pass, $db_name);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ตั้งค่า charset ให้รองรับภาษาไทย
$conn->set_charset("utf8_general_ci");

$message = ""; // เก็บข้อความแจ้งเตือน

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // ตรวจสอบชื่อผู้ใช้และรหัสผ่าน
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // ตรวจสอบรหัสผ่าน (ไม่มีการเข้ารหัส)
        if ($password === $row['password']) {
            session_regenerate_id(true); // ป้องกัน session fixation
            $_SESSION['username'] = $username; // ตั้งค่า session
            header("Location: index.php"); // ย้ายไปหน้า dashboard
            exit();
        } else {
            $message = "ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง!";
        }
    } else {
        $message = "ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง!";
    }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เข้าสู่ระบบ</title>
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
        <h2>เข้าสู่ระบบ</h2>
        <?php if (!empty($message)) echo "<p class='error'>$message</p>"; ?>
        <form method="POST" action="">
            <div class="form-group">
                <label for="username">ชื่อผู้ใช้</label>
                <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($prefill_username); ?>" required>
            </div>
            <div class="form-group">
                <label for="password">รหัสบัตรประชาชน</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn">เข้าสู่ระบบ</button>
        </form>
        <a href="register.php" class="register-btn">ลงทะเบียน</a>
    </div>
</body>
</html>
