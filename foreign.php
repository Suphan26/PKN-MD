<!DOCTYPE html>  
<html lang="th">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>PKN-MD eLEARNING</title>  
    <link href="https://fonts.googleapis.com/css2?family=K2D&display=swap" rel="stylesheet">  
    <style>  
        body {  
            font-family: 'K2D', sans-serif;  
            background-color: #0096b1;  
            margin: 0;  
            padding: 0;  
        }  
        header {  
            background-color: #0096b1;  
            color: white;  
            text-align: left;  
            padding: 20px;  
        }  
        .container {  
            max-width: 1200px;  
            margin: auto;  
            padding: 20px;  
            text-align: center;  
        }  
        .button {  
            display: block;  
            background-color: white;  
            border: 2px solid #0096b1;  
            border-radius: 25px;  
            padding: 15px 25px;  
            margin: 10px auto;  
            text-decoration: none;  
            color: #0096b1;  
            font-weight: bold;  
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);  
            transition: background-color 0.3s, color 0.3s;  
        }  
        .button:hover {  
            background-color: #0b505d;  
            color: white;  
        }  
        .image-container {  
            display: inline-block;  
            margin: 20px;  
            text-align: center;  
        }  
        .image {  
            width: 300px;  
            height: 300px;  
            object-fit: cover;  
        }  
        footer {  
            margin-top: 50px;  
            font-size: 0.8em;  
        }  
        .banner {  
            max-width: 100%;  
            height: auto;  
            display: block;  
        }  

        /* Media Query สำหรับหน้าจอขนาดเล็ก (มือถือ) */  
        @media (max-width: 768px) {  
            .image-container {  
                display: block; /* เปลี่ยนจาก inline-block เป็น block */  
                margin: 10px auto;  
            }  
            .image {  
                width: 100%; /* ใช้ความกว้างเต็มหน้าจอ */  
                max-width: 200px; /* กำหนดขนาดสูงสุดสำหรับภาพ */  
                height: auto; /* ให้ภาพปรับความสูงตามสัดส่วน */  
            }  
            .button {  
                width: 80%; /* ปรับปุ่มให้เล็กลง */  
            }  
            footer {  
                font-size: 0.9em;  
            }  
        }  
    </style>  
</head>  
<body>  
    <header>  
        <img src="../images/Banner2.png" alt="PKN-MD eLEARNING" class="banner">  
    </header>  
    <div class="container">  
        <div class="image-container">  
            <img src="../images/Login.png" alt="เข้าสู่ระบบ" class="image">  
            <a href="Login-eng.php" class="button">Login</a>  
        </div>  

        <div class="image-container">  
            <img src="../images/regis.png" alt="ลงทะเบียน" class="image">  
            <a href="register-eng.php" class="button">Register</a>  
        </div>  

        <div class="image-container">  
            <img src="../images/Foreigner.png" alt="For Foreigner" class="image">  
            <a href="page.php" class="button">สำหรับ คนไทย</a>  
        </div>  
    </div>  
    <footer>  
        <center>  
            <p>สำนักงานเจ้าหน้าที่ผู้มีอำนาจประจำจังหวัด โทร. 032-603929</p>  
        </center>  
    </footer>  
</body>  
</html>
