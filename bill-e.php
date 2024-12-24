<!doctype html>  
<html lang="th">  
<head>  
    <meta charset="utf-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>ใบเซอร์</title>  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">  
    <style>  
        body {  
            display: flex;  
            justify-content: center;  
            align-items: center;  
            min-height: 100vh;  
            background: linear-gradient(135deg, #b1c7e0, #2575fc);  
            margin: 0;  
        }  
        .certificate-container {  
            text-align: center;  
            background: #fff;  
            padding: 20px;  
            border-radius: 10px;  
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);  
        }  
        .certificate-container img {  
            max-width: 100%;  
            height: auto;  
            border-radius: 10px;  
        }  
        .download-button {  
            margin-top: 20px;  
        }  
    </style>  
    <script>  
        function redirectAfterDownload() {  
            setTimeout(() => {  
                window.location.href = 'page.php';  
            }, 1000); // รอ 1 วินาทีหลังจากกดดาวน์โหลด  
        }  
    </script>  
</head>  
<body>  
    <?php  
    session_start();  

    // ตั้งค่าการเชื่อมต่อฐานข้อมูล  
    $host = "localhost";  
    $db_user = "admin";  
    $db_pass = "admin";  
    $db_name = "login_system";  

    // เชื่อมต่อกับฐานข้อมูล  
    $conn = new mysqli($host, $db_user, $db_pass, $db_name);  

    // ตรวจสอบการเชื่อมต่อ  
    if ($conn->connect_error) {  
        die("Connection failed: " . $conn->connect_error);  
    }  

    // ตรวจสอบว่า session username ถูกตั้งค่าหรือไม่  
    if (!isset($_SESSION['username'])) {  
        echo "<p>กรุณาเข้าสู่ระบบก่อนเพื่อดูใบรับรอง</p>";  
        exit;  
    }  

    $username = $_SESSION['username'];  

    // ดึงข้อมูล password จากฐานข้อมูล  
    $sql = "SELECT password FROM users WHERE username = ?";  
    $stmt = $conn->prepare($sql);  
    $stmt->bind_param("s", $username);  
    $stmt->execute();  
    $result = $stmt->get_result();  

    if ($result->num_rows > 0) {  
        $row = $result->fetch_assoc();  
        $password = $row['password'];  
    } else {  
        $password = "ไม่พบข้อมูล";  
    }  

    $stmt->close();  
    $conn->close();  

    // สร้างรูปภาพใหม่ที่มีข้อความ  
    $imagePath = "../images/bill1.png"; // Path ของรูปต้นฉบับ  
    $outputPath = "../images/bill_with_text.png"; // Path ที่จะบันทึกรูปใหม่  

    if (file_exists($imagePath)) {  
        $image = imagecreatefrompng($imagePath); // สร้างรูปภาพจากไฟล์ PNG  

        // กำหนดสีและฟอนต์  
        $black = imagecolorallocate($image, 0, 0, 0); // กำหนดสีดำ  
        $fontPath = __DIR__ . "/THSarabunNew.ttf"; // ตรวจสอบให้มีไฟล์ฟอนต์อยู่ในโฟลเดอร์เดียวกัน  
        $fontSize = 70; // ขนาดฟอนต์  

        // ข้อความวันที่และเวลา  
        $date = date("d/m/Y");    
        $dateTimeText = "วันที่: $date";  

        // เขียนข้อความลงในรูป  
        $text = " $password";    
        imagettftext($image, $fontSize, 0, 475, 850, $black, $fontPath, $text);  
        imagettftext($image, 50, 0, 550, 1890, $black, $fontPath, $dateTimeText); // เพิ่มวันที่และเวลา  

        // บันทึกรูปใหม่  
        imagepng($image, $outputPath);  
        imagedestroy($image);  
    } else {  
        echo "<p>ไม่พบไฟล์รูปภาพ</p>";  
        exit;  
    }  
?>  

    <div class="certificate-container">  
        <h1>ใบรับรองของคุณ</h1>  
        <img src="../../../Users/Marine-PC66.LAPTOP-3ODE3RFV/images/bill_with_text.png" alt="ใบเซอร์">  
        <a class="btn btn-primary download-button" href="../../../Users/Marine-PC66.LAPTOP-3ODE3RFV/images/bill_with_text.png" download="ใบเซอร์.png" onclick="redirectAfterDownload()">ดาวน์โหลดใบเซอร์</a>  
    </div>  
</body>  
</html>
