<html>
<body>

<?php
    
    include_once('db.php');

    $str_json = file_get_contents('php://input'); //($_POST doesn't work here)
    
    $response = json_decode($str_json,true); // decoding received JSON to array
	
    $room_id = $response['room_id'];
    $room_id = $response['room_id'];
    //Delete room from bookings using room_id
    $sql =  "DELETE FROM bookings WHERE room_id=$room_id";
    $result = $conn->query($sql);
    
    if ($result === FALSE) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
?>

</body>
</html>