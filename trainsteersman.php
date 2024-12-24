<?php
session_start();

// ตรวจสอบว่าผู้ใช้เข้าสู่ระบบแล้ว
if (!isset($_SESSION['username'])) {
    header("Location: trainsteersman.php");
    exit;
}

$host = "localhost";
$db_user = "admin";
$db_pass = "admin";
$db_name = "login_system";

// เชื่อมต่อฐานข้อมูล
$conn = new mysqli($host, $db_user, $db_pass, $db_name);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ตั้งค่า charset ให้รองรับภาษาไทย
$conn->set_charset("utf8");

// ตรวจสอบข้อมูลผู้ใช้จาก session
$username = $_SESSION['username'];

// ดึงข้อมูลผู้ใช้จากฐานข้อมูล
$stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->bind_result($hashed_password);
$stmt->fetch();
$stmt->close();

if (!$hashed_password) {
    // หากไม่พบผู้ใช้ในฐานข้อมูล
    session_destroy();
    header("Location: trainsteersman.php");
    exit;
}
?>
<!doctype html>  
<html lang="th">  
<head>  
    <meta charset="utf-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>Responsive Website</title>  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">  
    <style>  
        body {  
            background: linear-gradient(135deg, #b1c7e0, #2575fc);  
            min-height: 100vh;  
            display: flex;  
            justify-content: center;  
            align-items: center;  
        }  
        .container {  
            max-width: 800px;  
            padding: 20px;  
            text-align: center;  
            background: #fff;  
            border-radius: 10px;  
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);  
        }  
        .video-container iframe {  
            width: 100%;  
            height: 400px;  
            border-radius: 10px;  
            margin-bottom: 20px;  
        }  
        .btn-container a {  
            display: inline-block;  
            padding: 10px 20px;  
            font-size: 16px;  
            background-color: #007bff;  
            color: #fff;  
            text-decoration: none;  
            border-radius: 5px;  
            pointer-events: none; /* ปิดการคลิกในตอนแรก */  
            opacity: 0.5; /* ทำให้ดูเหมือนยังใช้งานไม่ได้ */  
            transition: opacity 0.3s, pointer-events 0.3s;  
        }  
        .btn-container a.enabled {  
            pointer-events: auto; /* เปิดการคลิก */  
            opacity: 1; /* ทำให้ดูเหมือนใช้งานได้ */  
        }  
    </style>  
</head>  
<body>  
    <div class="container">  
        <h1>การอบรมของ <?php echo htmlspecialchars($username); ?></h1>  
        <div class="video-container">  
            <iframe id="video-player" src="https://www.youtube.com/embed/QC8iQqtG0hg?enablejsapi=1&controls=0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>  
        </div>  
        <div class="btn-container">  
            <a href="posttest.php" id="next-btn" class="disabled">ปุ่มถัดไป</a>  
        </div>  
    </div>  

   <!-- YouTube Iframe API -->  
<script src="https://www.youtube.com/iframe_api"></script>  
<script>  
    var player;  
    var nextBtn = document.getElementById("next-btn");  

    // ฟังก์ชันเรียกใช้ YouTube API  
    function onYouTubeIframeAPIReady() {  
        player = new YT.Player('video-player', {  
            events: {  
                'onStateChange': onPlayerStateChange // ตรวจสอบการเปลี่ยนสถานะ  
            }  
        });  
    }  

    // ฟังก์ชันตรวจสอบสถานะของ player  
    function onPlayerStateChange(event) {  
        if (event.data === YT.PlayerState.ENDED) {  
            // เมื่อวิดีโอสิ้นสุด อัปเดตปุ่มให้ใช้งานได้  
            nextBtn.classList.add("enabled"); // ใช้คำสั่ง add class แทน remove  
        } else {  
            nextBtn.classList.remove("enabled"); // ถ้าวิดีโอไม่ได้จบ ให้ลบ class  
        }  
    }	  
</script>  

</body>  

</html>