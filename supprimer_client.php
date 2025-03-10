<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM clients WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        header("Location: clients.php");
    }
}
?>
