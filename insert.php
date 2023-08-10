<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pickup";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$text = $_GET['text'];
$sql = "INSERT INTO pickup (text) VALUES ('$text')";

if ($conn->query($sql) === TRUE) {
    echo "<br>";
} else {
    echo "Error while inserting the value: " . $conn->error;
}

$sql = "SELECT * FROM pickup WHERE id=(SELECT MAX(id) FROM pickup)";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "Text is: " . $_GET["text"] . "<br>ID: " . $row["id"];
    }
} else {
    echo "There is no data in the table";
}

$conn->close();
?>

<button onclick="goBack()">Go Back</button>

<script>
    function goBack() {
        window.history.back();
    }
</script>