<html>
<body>

<?php
    
    include_once('db.php');

    $str_json = file_get_contents('php://input'); //($_POST doesn't work here)
    
    $response = json_decode($str_json,true); // decoding received JSON to array
	
    $reviewText = strip_tags($response['reviewText']);
    $room_id = $response['room_id'];
    $rate = $response['rate'];
    
    $sql =  "SELECT * FROM reviews WHERE room_id=$room_id";
	$result = $conn->query($sql);
    
    if ($result->num_rows == 0) {
    
        $tsql =  "INSERT INTO reviews (rate,text,user_id,room_id) VALUES ($rate,'$reviewText',1,$room_id)";
        if ($conn->query($tsql) === TRUE) {
            $sql = "SELECT * FROM reviews WHERE room_id=$room_id";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                // output data of each row
                $reviewCounter = 0;
                while($row = $result->fetch_assoc()) {
                    $reviewCounter++;
                    ?>
                    <div class="row" id="listReviews">
                        <div class="col-sm-12">
                            <h5><?php echo $reviewCounter;?> - user_default1 - 
                            <?php for ($i = 0; $i < $row["rate"] ; $i++) { ?>
                                <i class="fa fa-star"></i>
                            <?php } ?>
                            </h5>
                            <p style="font-size:0.8em">Add time: <?php echo $row["date_created"];?></p>
                            <p><?php echo htmlentities($row["text"]);?></p>
                        </div>
                    </div>
                    <?php
                }
            } 
            $conn->close();  
        } else {
            echo "Error: " . $tsql . "<br>" . $conn->error;
        }
    } else {
         echo "<em>Already reviewed this room.</em>";
    }
?>

</body>
</html>