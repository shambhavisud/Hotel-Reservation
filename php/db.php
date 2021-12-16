<html>
<body>

<?php
    $conn = mysqli_connect("localhost", "root", "","wda_db") or die (mysql_error());
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    // echo "connection successfull";
    
?>
</body>
</html>