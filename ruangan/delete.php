<?php
require_once "../classes/ruangan.php";
$ruangan = new ruangan();

$id = $_GET['id'];
$ruangan->delete($id);
header("Location: index.php");
