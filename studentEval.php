<?php
require_once("includes/initialize.php");

$id = $_GET['id'] ?? $_GET['studentId'] ?? '';
if (!empty($id)) {
    header("Location: Student_advicesubject.php?studentId=" . urlencode($id));
    exit;
} else {
    header("Location: studentList.php");
    exit;
}
