<?php
session_start();
if (!isset($_SESSION['username'])) {
    $_SESSION['username'] = "ผู้ใช้ที่ไม่ได้ล็อกอิน"; // กำหนดค่าชั่วคราว
}
?>
<!DOCTYPE html>
<html lang="th"><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แบบทดสอบความรู้</title>
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
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 0;
        }

        .quiz-container {
            background-color: #ffffff;
            max-width: 800px;
            margin: 30px auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #0096b1;
            font-size: 22px;
        }

        .question {
            margin-bottom: 20px;
        }

        .answers {
            margin-left: 20px;
        }

        .answers input[type="radio"] {
            margin-right: 10px;
        }

        .btn-container {
            display: flex;
            justify-content: space-between;
        }

        .btn-container button {
            width: 48%;
        }

        .btn-next, .btn-prev {
            font-size: 16px;
            padding: 10px 20px;
        }

        .btn-next {
            background-color: #28a745;
            color: white;
        }

        .btn-prev {
            background-color: #007bff;
            color: white;
        }

        .btn-next:hover, .btn-prev:hover {
            opacity: 0.8;
        }
		
    </style>
</head>
<body>
	 <div class="container">
        <!-- Welcome Banner -->
        <div class="welcome-banner">
            <h1>
    <span class="icon-user">&#128100;</span> <!-- ไอคอนผู้ใช้ -->
    <?php echo htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8'); ?>
			</h1>

            <!-- ปุ่ม Shutdown -->
            <button class="shutdown-btn" onclick="shutdown()">
                <span class="icon">&#x23FB;</span> ปิดระบบ
            </button>
        </div>
		 <center>
		  <a>
    <img src="../images/pretest1.png" alt="Pretest" width="200" height="200">
		  </a>
		 </center>
    <div class="quiz-container">
        <h1>แบบทดสอบความรู้เกี่ยวกับนายท้ายเรือ</h1>

        <form id="quizForm">
            <!-- Question 1 -->
            <div class="question" id="question1">
                <p>1. หน้าที่หลักของนายท้ายเรือคืออะไร?</p>
                <div class="answers">
                    <label><input type="radio" name="q1" value="a"> ก. บังคับหางเสือเรือ</label><br>
                    <label><input type="radio" name="q1" value="b"> ข. ตรวจจับปลา</label><br>
                    <label><input type="radio" name="q1" value="c"> ค. ดูแลผู้โดยสาร</label><br>
                    <label><input type="radio" name="q1" value="d"> ง. ซ่อมแซมเครื่องยนต์</label>
                </div>
            </div>

            <!-- Question 2 -->
            <div class="question" id="question2" style="display: none;">
                <p>2. ชูชีพประเภทใดที่เหมาะสำหรับผู้โดยสาร?</p>
                <div class="answers">
                    <label><input type="radio" name="q2" value="a"> ก. ชูชีพแข็ง</label><br>
                    <label><input type="radio" name="q2" value="b"> ข. ชูชีพเป่าลม</label><br>
                    <label><input type="radio" name="q2" value="c"> ค. เสื้อชูชีพมาตรฐาน</label><br>
                    <label><input type="radio" name="q2" value="d"> ง. ห่วงชูชีพ</label>
                </div>
            </div>

            <!-- Question 3 -->
            <div class="question" id="question3" style="display: none;">
                <p>3. ก่อนออกเรือ ควรตรวจสอบอะไรเป็นอันดับแรก?</p>
                <div class="answers">
                    <label><input type="radio" name="q3" value="a"> ก. อวนจับปลา</label><br>
                    <label><input type="radio" name="q3" value="b"> ข. เครื่องยนต์เรือ</label><br>
                    <label><input type="radio" name="q3" value="c"> ค. จำนวนลูกเรือ</label><br>
                    <label><input type="radio" name="q3" value="d"> ง. สีของเรือ</label>
                </div>
            </div>

            <!-- Question 4 -->
            <div class="question" id="question4" style="display: none;">
                <p>4. สัญญาณฉุกเฉินในทะเลคืออะไร?</p>
                <div class="answers">
                    <label><input type="radio" name="q4" value="a"> ก. การโบกธง</label><br>
                    <label><input type="radio" name="q4" value="b"> ข. การยิงพลุสัญญาณ</label><br>
                    <label><input type="radio" name="q4" value="c"> ค. การเปิดไฟหน้า</label><br>
                    <label><input type="radio" name="q4" value="d"> ง. การตะโกนเรียก</label>
                </div>
            </div>

            <!-- Question 5 -->
            <div class="question" id="question5" style="display: none;">
                <p>5. เสื้อชูชีพสีใดเห็นได้ชัดเจนที่สุดในน้ำ?</p>
                <div class="answers">
                    <label><input type="radio" name="q5" value="a"> ก. สีเขียว</label><br>
                    <label><input type="radio" name="q5" value="b"> ข. สีดำ</label><br>
                    <label><input type="radio" name="q5" value="c"> ค. สีฟ้า</label><br>
                    <label><input type="radio" name="q5" value="d"> ง. สีส้ม</label>
                </div>
            </div>

            <!-- Question 6 -->
            <div class="question" id="question6" style="display: none;">
                <p>6. การตรวจเช็คอุปกรณ์ช่วยชีวิตควรทำเมื่อใด?</p>
                <div class="answers">
                    <label><input type="radio" name="q6" value="a"> ก. ก่อนออกเรือทุกครั้ง</label><br>
                    <label><input type="radio" name="q6" value="b"> ข. เมื่อเกิดเหตุฉุกเฉิน</label><br>
                    <label><input type="radio" name="q6" value="c"> ค. เดือนละครั้ง</label><br>
                    <label><input type="radio" name="q6" value="d"> ง. ปีละครั้ง</label>
                </div>
            </div>

            <!-- Question 7 -->
            <div class="question" id="question7" style="display: none;">
                <p>7. หางเสือเรือทำหน้าที่อะไร?</p>
                <div class="answers">
                    <label><input type="radio" name="q7" value="a"> ก. ควบคุมทิศทางเรือ</label><br>
                    <label><input type="radio" name="q7" value="b"> ข. เพิ่มความเร็วเรือ</label><br>
                    <label><input type="radio" name="q7" value="c"> ค. ลดความเร็วเรือ</label><br>
                    <label><input type="radio" name="q7" value="d"> ง. ขับเคลื่อนเรือ</label>
                </div>
            </div>

            <!-- Question 8 -->
            <div class="question" id="question8" style="display: none;">
                <p>8. ระบบการสื่อสารทางวิทยุในเรือใช้เพื่ออะไร?</p>
                <div class="answers">
                    <label><input type="radio" name="q8" value="a"> ก. ติดต่อกับเรืออื่นๆ</label><br>
                    <label><input type="radio" name="q8" value="b"> ข. ส่งเสียงเพลง</label><br>
                    <label><input type="radio" name="q8" value="c"> ค. รับสัญญาณจากดาวเทียม</label><br>
                    <label><input type="radio" name="q8" value="d"> ง. ส่งสัญญาณขอความช่วยเหลือ</label>
                </div>
            </div>

            <!-- Question 9 -->
            <div class="question" id="question9" style="display: none;">
                <p>9. เรือลำไหนที่ควรได้รับการบำรุงรักษามากที่สุด?</p>
                <div class="answers">
                    <label><input type="radio" name="q9" value="a"> ก. เรือที่ใช้บ่อย</label><br>
                    <label><input type="radio" name="q9" value="b"> ข. เรือที่ไม่ได้ใช้งานเลย</label><br>
                    <label><input type="radio" name="q9" value="c"> ค. เรือที่ใหม่ที่สุด</label><br>
                    <label><input type="radio" name="q9" value="d"> ง. เรือที่เก่าแก่ที่สุด</label>
                </div>
            </div>

            <!-- Question 10 -->
            <div class="question" id="question10" style="display: none;">
                <p>10. ควรเก็บเสื้อชูชีพไว้ที่ไหน?</p>
                <div class="answers">
                    <label><input type="radio" name="q10" value="a"> ก. ใต้ท้องเรือ</label><br>
                    <label><input type="radio" name="q10" value="b"> ข. ใกล้ทางออก</label><br>
                    <label><input type="radio" name="q10" value="c"> ค. ในห้องเครื่อง</label><br>
                    <label><input type="radio" name="q10" value="d"> ง. ในห้องโดยสาร</label>
                </div>
            </div>

            <!-- Buttons -->
            <div class="btn-container">
                <button type="button" class="btn-prev" id="prevBtn" style="display: none;" onclick="moveQuestion(-1)">ย้อนกลับ</button>
                <button type="button" class="btn-next" id="nextBtn" onclick="moveQuestion(1)">ถัดไป</button>
            </div>
        </form>

        <!-- Result -->
        <div id="result" style="display: none;">
            <h2>ผลการทดสอบ</h2>
            <p id="score"></p>
            <button type="button" class="btn btn-primary" onclick="goToNextPage()">ไปยังหน้าถัดไป</button>
        </div>
    </div>

    <script>
        let currentQuestion = 1;
        const totalQuestions = 10;
        let score = 0;

        const correctAnswers = {
            q1: 'a',
            q2: 'c',
            q3: 'b',
            q4: 'b',
            q5: 'd',
            q6: 'a',
            q7: 'a',
            q8: 'd',
            q9: 'd',
            q10: 'b'
        };

        function moveQuestion(step) {
    // Hide the current question
    document.getElementById('question' + currentQuestion).style.display = 'none';

    // Update current question
    currentQuestion += step;

    // Show the next question
    document.getElementById('question' + currentQuestion).style.display = 'block';

    // Show/Hide buttons based on current question
    if (currentQuestion === 1) {
        document.getElementById('prevBtn').style.display = 'none';
    } else {
        document.getElementById('prevBtn').style.display = 'inline-block';
    }

    if (currentQuestion === totalQuestions) {
        document.getElementById('nextBtn').innerText = 'เสร็จสิ้น';
    } else {
        document.getElementById('nextBtn').innerText = 'ถัดไป';
    }

    // เมื่อกดปุ่ม "เสร็จสิ้น" ในข้อ 10
    if (currentQuestion === totalQuestions && document.getElementById('nextBtn').innerText === 'เสร็จสิ้น') {
        calculateScore();
    }
}

        function calculateScore() {
            // Loop through all questions and check the answers
            for (let i = 1; i <= totalQuestions; i++) {
                const selectedAnswer = document.querySelector(`input[name="q${i}"]:checked`);
                if (selectedAnswer && selectedAnswer.value === correctAnswers[`q${i}`]) {
                    score++;
                }
            }

            // Hide quiz and show result
            document.getElementById('quizForm').style.display = 'none';
            document.getElementById('result').style.display = 'block';
            document.getElementById('score').innerText = `คุณได้คะแนน: ${score} จาก ${totalQuestions}`;
        }

        function goToNextPage() {
            // Redirect to the next page or display a message
            window.location.href = "trainsteersman.php";  // Replace with your next page URL
        }
    </script>
		 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function shutdown() {
            if (confirm("คุณต้องการปิดระบบหรือไม่?")) {
                // ใช้ fetch เพื่อเรียกไปยัง logout.php
                fetch('logout.php', {
                    method: 'POST'
                }).then(() => {
                    window.location.href = "page.php"; // เปลี่ยนเส้นทาง
                }).catch((error) => {
                    alert("เกิดข้อผิดพลาด: " + error.message);
                });
            }
        }
    </script>
</body>
</html>
																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																									