<?php
session_start();
include 'config.php';

if (!isset($_SESSION['nim'])) {
    header("Location: login.php");
}

$nim = $_SESSION['nim'];
$last_digit = (int)substr($nim, -1);

if ($last_digit % 2 == 0) {
    echo "Anda tidak berhak memasukkan data untuk group B.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $country_name = $_POST['country_name'];
    $wins = $_POST['wins'];
    $draws = $_POST['draws'];
    $losses = $_POST['losses'];
    $points = ($wins * 3) + $draws;

    $query = "INSERT INTO countries (group_id, country_name, wins, draws, losses, points) 
              VALUES (2, '$country_name', $wins, $draws, $losses, $points)";
    mysqli_query($conn, $query);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Input Data Group B</title>
    <a href="logout.php">Logout</a>
</head>
<body>
    <form method="POST" action="">
        <label>Nama Negara:</label>
        <input type="text" name="country_name" required><br>
        <label>Menang:</label>
        <input type="number" name="wins" required><br>
        <label>Seri:</label>
        <input type="number" name="draws" required><br>
        <label>Kalah:</label>
        <input type="number" name="losses" required><br>
        <button type="submit">Simpan</button>
    </form>
</body>
</html>
