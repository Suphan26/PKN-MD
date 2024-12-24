<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: Renew.php");
    exit;
}
?>
<!doctype html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Renew Page</title>
    <!-- ใช้ Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            background: linear-gradient(135deg, #0096b1, #0096b1);
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            min-height: 100vh;
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
        .logout-btn {
            background-color: #FF5757;
            color: #fff;
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
        .logout-btn:hover {
            background-color: #FF3030;
            transform: scale(1.05);
        }
        .logout-btn .icon {
            font-size: 20px;
        }
        .image-grid {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
            margin-top: 30px;
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
                <span class="icon-user">&#128100;</span>
                <?php echo htmlspecialchars($_SESSION['username']); ?>
            </h1>
            <a href="logout.php" class="logout-btn">
                <span class="icon">&#x23FB;</span> ปิดระบบ
            </a>
        </div>

        <!-- Images -->
        <div class="image-grid">
            <a href="trainsteersman.php">
                <img src="../images/steersman-eng.png" alt="Steersman">
            </a>
            <a href="mechanic.php">
                <img src="../images/mechanic-eng.png" alt="Mechanic">
            </a>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
