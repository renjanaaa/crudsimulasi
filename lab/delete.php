<?php
require_once "../classes/lab.php";
$lab = new lab();

$id = $_GET['id'];
$lab->delete($id);
header("Location: index.php");
