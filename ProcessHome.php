<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "bottle_project";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("เชื่อมต่อฐานข้อมูลล้มเหลว: " . $conn->connect_error);
}

$studentnumber = $_POST['studentnumber'];
$graderoom = $_POST['graderoom'];

$sql = "SELECT * FROM student_rt WHERE studentnumber = ? ORDER BY last_updated DESC LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $studentnumber);
$stmt->execute();
$result = $stmt->get_result();

$sql = "INSERT INTO student_rt (studentnumber, graderoom) 
        VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $studentnumber, $graderoom);
$stmt->execute();

header("Location: type.html");
exit;
?>
