<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "bottle_project";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("เชื่อมต่อฐานข้อมูลล้มเหลว: " . $conn->connect_error);
}

$textdate = $_POST['textdate'];     
$cap_code = (int)$_POST['cap_code'];

$sql = "SELECT * FROM student_rt WHERE studentnumber = ? ORDER BY last_updated DESC LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $studentnumber);
$stmt->execute();
$result = $stmt->get_result();

$sql = "INSERT INTO student_rt (textdate, cap_code) 
        VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $textdate, $cap_code);
$stmt->execute();

header("Location: Rtpoint.html");
exit;
?>