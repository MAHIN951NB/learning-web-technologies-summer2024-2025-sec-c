<?php
$host = "127.0.0.1";
$dbuser = "root";
$dbpass = "";
$dbname = "verification";

function getConnection() {
    global $host, $dbuser, $dbpass, $dbname;
    static $conn = null;
    if ($conn === null) {
        $conn = mysqli_connect($host, $dbuser, $dbpass, $dbname);
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }
    return $conn;
}
?>
