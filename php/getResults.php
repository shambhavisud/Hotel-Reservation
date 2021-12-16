<html>
<body>

<?php
    
    include_once('db.php');

    $str_json = file_get_contents('php://input');
    
    $response = json_decode($str_json,true); // decoding received JSON to array
	
	
    $city = $response['city'];
    $roomType = $response['roomType'];  
    $CountOfGuests = $response['CountOfGuests'];  
    $min = $response['min'];
    $max = $response['max'];
    $sql = "SELECT * FROM room";
    if($city!=="" || $CountOfGuests !=="" || $roomType!=="") {
        $sql = "SELECT * FROM room WHERE";
    }

    // making sql string 
    if($city!=="" && $CountOfGuests !=="" && $roomType!=="") {
        $sql =  $sql.  " room_type=$roomType AND city='$city' AND count_of_guests=$CountOfGuests AND price BETWEEN $min AND $max";
    } else if ($city !== "" &&  $CountOfGuests !=="") {
        $sql = $sql . " city='$city' AND count_of_guests=$CountOfGuests AND price BETWEEN $min AND $max";
    } else if ($city !== "" &&  $roomType !=="") {
        $sql = $sql . " city='$city' AND room_type=$roomType AND price BETWEEN $min AND $max";
    } else if ($roomType!=="" && $CountOfGuests!=="") {
        $sql =  $sql.  " room_type=$roomType AND count_of_guests=$CountOfGuests AND price BETWEEN $min AND $max";
    } else if ($city!=="") {
        $sql = $sql . " city='$city' AND price BETWEEN $min AND $max";
    } else if ($roomType!=="") {
        $sql =  $sql.  " room_type=$roomType AND price BETWEEN $min AND $max";        
    } else if ($CountOfGuests!=="") {
        $sql =  $sql.  " count_of_guests=$CountOfGuests AND price BETWEEN $min AND $max";
    } else {
        $sql = $sql. " WHERE price BETWEEN $min AND $max";
    }

	$result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
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
                            <img src="images/rooms/<?php echo $row["photo"]?>">
                        </div>
                        
                        <div class="col-sm-9 itemBody">
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
                                <p>Per Night: <?php echo $row["price"];?>₹</p>
                            </div>
                        </div>
                        <div class="col-sm-9">
                            <div class="info">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <p>Count of Guests: <?php echo $row["count_of_guests"];?></p>
                                    </div>
                                    <div class="col-sm-6">
                                        <p>Type of Room: <?php echo $row["room_type"];?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
        }
    } else {
        echo "<h5>No Results :(</h5>";
    }
    $conn->close();
?>

</body>
</html>