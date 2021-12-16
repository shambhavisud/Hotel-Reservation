<html>
<body>

<?php
    
    include_once('db.php');
    $str_json = file_get_contents('php://input'); //($_POST doesn't work here)  
    $response = json_decode($str_json,true); // decoding received JSON to array
    $room_id = $response['room_id'];
    
    $sql =  "SELECT * FROM favorites WHERE room_id=$room_id";
	$result = $conn->query($sql);
    
    if ($result->num_rows > 0) {        
        while($row = $result->fetch_assoc()) {
            if($row["status"]==1) {
                $tsql =  "UPDATE favorites
                SET status = 0
                WHERE room_id=$room_id";
                if ($conn->query($tsql) === TRUE) {
                }
                $conn->close();  
            } else {
                $tsql =  "UPDATE favorites
                SET status = 1
                WHERE room_id=$room_id";
                if ($conn->query($tsql) === TRUE) {
                }
                $conn->close();  
            }
        }
        $conn->close();  
    } else {
        $tsql =  "INSERT INTO favorites (status,user_id,room_id) VALUES (1,1,$room_id)";
        if ($conn->query($tsql) === TRUE) {
            $conn->close();  
        } else {
            echo "err";
        }
    }
?>

</body>
</html>