<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'head.html' ?>
    <link rel="stylesheet" type="text/css" href="css/list.css">
</head>

<body>
    <?php include 'header.html' ?>
    
    <!-- MAIN CONTAINER -->
    <div class="container" id="mainBody">
        <div class="row">
            <!-- SIDE MENU - FILTERS -->
            <div class="col-lg-3" >
                <div class="container-fluid" id="filters">
                <h5 style="text-align: center">FIND THE PERFECT HOTEL</h5>
                <!-- FORM -->
                <form>
                    <select id="CountOfGuests" >
                        <option value="">Count of guests</opiton>
                        <?php
                        include_once('php/db.php');
                            $sql =  'SELECT DISTINCT count_of_guests FROM room';
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                            ?>
                            <option value="<?php echo $row["count_of_guests"];?>"><?php echo $row["count_of_guests"];?></option>
                            <?php 
                                }
                            }
                            ?>
                    </select>
                    <select id="roomType" >
                        <option value="">Room Type</opiton>
                        <?php 
                            include_once('php/db.php');
                            $sql =  'SELECT * FROM room_type';
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                            ?>
                            <option value="<?php echo $row["id"];?>"><?php echo $row["room_type"];?></option>
                            <?php 
                                }
                            }
                            ?>
                    </select>
                    <select id="city" >
                        <option value="">City</opiton>
                        <?php 
                        include_once('php/db.php');
                        $sql =  'SELECT DISTINCT city FROM room';
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                        ?>
                        <option value="<?php echo $row["city"];?>"><?php echo $row["city"];?></option>
                        <?php 
                            }
                        }
                        ?>
                    </select>
                    <div class="row">
                        <div class="col-sm-12">
                            <input type="text" id="min" readonly>
                            <input type="text" id="max" readonly>                            
                        </div>
                    </div>
                    <div id="slider-range"></div>
                    <div class="row">
                        <div class="col-sm-12">
                            <p style="float:left;font-size:0.9em;color:white;">MIN</p>
                            <p style="float:right;font-size:0.9em;color:white;">MAX</p>                            
                        </div>
                    </div>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="calendarIcon"><i class="fa fa-calendar"></i></span>
                        </div>
                        <input id="checkIn" type="text" class="datepicker form-control" placeholder="Check-in" 
                        value="<?php if (isset($_POST["checkIn"])) {
                            echo $_POST['checkIn'];
                        } 
                        ?>" readonly>
                    </div>
                    <div class="input-group" id="checkOutDiv">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="calendarIcon2"><i class="fa fa-calendar"></i></span>
                        </div>
                        <input id="checkOut" type="text" class="datepicker form-control" placeholder="Check-out"
                        value="<?php if(isset($_POST["checkOut"])){
                            echo $_POST['checkOut'];
                        }
                        ?>" readonly>
                        
                    </div>
                </form>
                </div>
            </div>

            <!-- MAIN BODY - ROOMS -->
            <div class="col-lg-9">
                <div class="bookingHeading">
                    <h5>Search Results</h5>
                </div>
                <!-- RESULTS HERE -->
                <div id="result">
                <?php  
                include_once('php/db.php');
                
                if(isset($_POST["city"]) && $_POST["city"]!== "") {
                    $city = $_POST["city"];
                    if(isset($_POST["roomType"]) && $_POST["roomType"] !== "") {
                        $roomType= $_POST["roomType"];
                        $sql =  "SELECT * FROM room WHERE city='$city' AND room_type=$roomType";
                    } else {
                        $sql =  "SELECT * FROM room WHERE city='$city'"; 
                    }
                } else if(isset($_POST["roomType"]) && $_POST["roomType"] !== "") {
                    $roomType= $_POST["roomType"];
                    $sql =  "SELECT * FROM room WHERE room_type=$roomType";                  
                } else {
                    $sql = 'SELECT * FROM room';
                }
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                    // output data of each row
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
                        } ?>
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
                                    <div class="col-sm">
                                        <button class="btn btn-success goToRoom" onclick="goToRoom('<?php echo $row["name"];?>')">Go to Room</button>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="price">
                                            <p>Per Night:<span class="priceValue"> <?php echo $row["price"];?></span>₹</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="info">
                                            <div class="row">
                                                <div class="col-sm-6 ">
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
                </div>
            </div>
        </div>
        <!-- mainContainer -->
    </div>
    <div id="postCity" value="<?php echo $_POST["city"] ?>"></div>
    <div id="postRoomType" value="<?php echo $_POST["roomType"]?>"></div>
    
    <?php include 'footer.html' ?>
    <?php  include 'scripts.html' ?>
    <script src="js/datepicker.js"></script>
    <script src="js/list.js"></script>
    <script>
    
    </script>
</body>

</html>