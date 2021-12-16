<html>
<body>

<?php
    
    include_once('db.php');

    $str_json = file_get_contents('php://input'); //($_POST doesn't work here)
    
    // $response = json_decode($str_json,true); // decoding received JSON to array
	

    $sql =  "SELECT * FROM bookings";
	$result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        // output data of each row
        while($row1 = $result->fetch_assoc()) {
            $checkIn = $row1["check_in_date"];
            $checkOut = $row1["check_out_date"];            
            $sql1 =  'SELECT * FROM room WHERE room_id='.$row1["room_id"].'';
            $result1 = $conn->query($sql1);
            while($row = $result1->fetch_assoc()) {
                if($row["room_type"]==1){
                    $row["room_type"] = "Single Room";
                }
                if($row["room_type"]==2){
                    $row["room_type"] = "Double Room";
                }
                if($row["room_type"]==3){
                    $row["room_type"] = "Triple Room";
                }   
                if($row["room_type"]==4){
                    $row["room_type"] = "Fourfold Room";
                }?>
                <div class="container resultItem">
                    <div class="row">
                        <div class="col-sm-3">
                            <img src="images/rooms/<?php echo $row["photo"];?>">
                        </div>
                        
                        <div class="col-sm-9" id="itemBody">
                            <h5><?php echo $row["name"]?></h5>
                            <h6><?php echo $row["city"].','.$row["area"];?></h6>
                            <p><?php echo $row["short_description"];?></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <button class="btn btn-success goToRoom" onclick="goToRoom('<?php echo $row["name"];?>')">Go to Room</button>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-3">
                            <div class="price">
                                <p>Total Cost: <?php 
                                $firstDate = strtotime($checkIn); // or your date as well
                                $secondDate = strtotime($checkOut);
                                $datediff =  $secondDate - $firstDate;
                                echo (round($datediff / (60 * 60 * 24))) * $row["price"];
                                ?>₹</p>
                            </div>
                        </div>
                        <div class="col-sm-9">
                            <div class="info">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <p>Check in: <?php echo $checkIn;?></p>
                                    </div>
                                    <div class="col-sm-4">
                                        <p>Check out: <?php echo $checkOut;?></p>
                                    </div>
                                    <div class="col-sm-4">
                                        <p> <?php echo $row["room_type"];?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    <!-- Results  -->
            <?php
            }
        }   
    } else {
        echo "<h5>No Results :(</h5>";
    }
    $conn->close();
?>

</body>
</html>