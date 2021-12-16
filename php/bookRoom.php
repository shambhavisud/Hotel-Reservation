<html>
<body>

<?php
    
    include_once('db.php');

    $str_json = file_get_contents('php://input'); //($_POST doesn't work here)
    
    $response = json_decode($str_json,true); // decoding received JSON to array
	
    // $room_id = $response['room_id'];
    // $checkIn = $response['checkIn'];
    // $checkOut = $response['checkOut'];  
    
    $currTmp = $response['currTmp'];
    $checkIn = $response['checkIn'];
    $checkOut = $response['checkOut'];
    $room_id = $response['room_id'];
    //Insert room into database
    $sql =  "INSERT INTO bookings (check_in_date, check_out_date,date_created,user_id,room_id) VALUES ('$checkIn','$checkOut','$currTmp','1',$room_id)";
    $result = $conn->query($sql);
    
    if ($result === FALSE) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    $conn->close();
?>

</body>
</html>