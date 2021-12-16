<html>
<body>

<?php
    
    include_once('db.php');

    $str_json = file_get_contents('php://input'); //($_POST doesn't work here)
    
    // $response = json_decode($str_json,true); // decoding received JSON to array
	

    $sql =  "SELECT * FROM favorites";
	$result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        // output data of each row
        $counter = 0;
        while($row = $result->fetch_assoc()) {
            $sql1 =  'SELECT * FROM room WHERE room_id='.$row["room_id"].'';
            $result1 = $conn->query($sql1);
            while($row1 = $result1->fetch_assoc()) {
                if($row["status"]==1) {    
                    $counter++;   ?>
                    <h4><?php echo $counter.". ".$row1["name"];?></h4>
                <?php
                }
            }
        }   
    } else {
        echo "<p>No Favorite rooms yet :(</p>";
    }
    $conn->close();
?>

</body>
</html>