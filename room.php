<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'head.html' ?>             
    <link rel="stylesheet" type="text/css" href="css/room.css">
</head>
<body>
    <?php include 'header.html'?>
    
    <?php 
        $name = $_GET["name"];
        include_once('php/db.php');
        $sql =  "SELECT * FROM room WHERE name='$name'";
        $result = $conn->query($sql);

        
        
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                
                $sql1 = 'SELECT * FROM reviews WHERE room_id='.$row["room_id"].'';
                $result1 = $conn->query($sql1);
                if ($result1->num_rows > 0) {
                    while($row1 = $result1->fetch_assoc()) {
                        $rate = $row1["rate"];
                    }
                } else {
                    $rate=0;    
                }

                $sql2 = 'SELECT * FROM favorites WHERE room_id='.$row["room_id"].'';
                $result2 = $conn->query($sql2);
                if ($result2->num_rows > 0) {
                    while($row2 = $result2->fetch_assoc()) {
                        $status = $row2["status"];
                    }
                    ?>
                    <div id="status" value="<?php echo $status;?>"></div>
                    <?php
                } else {
                    $status = 0;?>
                    <div id="status" value="<?php echo $status;?>"></div>
                    <?php
                }

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
                }
                if($row["pet_friendly"]) {
                    $pet_friendly = "";
                } else {
                    $pet_friendly = "Not";
                }
                if($row["wifi"]==1) {
                    $wifi = "Yes";
                } else {
                    $wifi = "No";                    
                } 
                if($row["parking"]==1) {
                    $parking = "Has";
                } else {
                    $parking = "No";                    
                } 

                $sqlBook = 'SELECT * FROM bookings WHERE room_id='.$row["room_id"].'';
                $result1 = $conn->query($sqlBook);
                if($result1->num_rows > 0){
                    $buttonValue = "Cancel Booking";
                    $buttonClass = "btn-danger";                                     
                } else {
                    $buttonValue = "Book it";  
                    $buttonClass = "btn-success";                 
                }
                ?>
                
                <!-- Main Body  -->
                <div class="container" id="mainBody">
            
                    <div class="row">
                        <div class="col-sm-12">
                            <div id="bookingHeading">
                                <p><?php echo $row["name"]." - ".$row["city"].", ".$row["area"];?>
                                <?php
                                if($rate!==0){ 
                                    ?>| Reviews: <?php
                                    for ($i = 0; $i < $rate ; $i++) { ?>
                                        <i class="fa fa-star"></i>
                                    <?php 
                                    } 
                                }   ?>
                                | <input type="checkBox" id="heart" name="favortie" value="On" />
                                <label class="full" for="heart" title="Favorite"></label>
                                | Per night: <?php echo $row["price"] ;?>₹</p>
                            </div>
                        </div>
                    </div>
            
                    <div class="row">
                        <div class="col-sm-6">
                            <img src="images/rooms/<?php echo $row["photo"];?>" alt="room-image-here">
                        </div>
                    </div>
            
                    <div class="row">
                        <div class="col-sm-12">
                            <nav id="info">
                            <ul class="infoMenu">
                                <li class="infoLi">
                                    <p class="infoText"><i class="fa fa-user" aria-hidden="true"></i> Guests: <?php echo $row["count_of_guests"];?></p>
                                </li>
                                <li class="infoLi">
                                    <p class="infoText"><i class="fa fa-hotel" aria-hidden="true"></i> <?php echo $row["room_type"];?></p>
                                </li>
                                <li class="infoLi">
                                    <p class="infoText"><i class="fa fa-car" aria-hidden="true"></i> <?php echo $parking;?> Parking</p>
                                </li>
                                <li class="infoLi">
                                    <p class="infoText"><i class="fa fa-wifi" aria-hidden="true"></i> WIFI: <?php echo $wifi;?></p>
                                </li>
                                <li class="infoLi">
                                    <p class="infoText"><i class="fa fa-paw" aria-hidden="true"></i> <?php echo $pet_friendly;?> Pet Friendly</p>
                                </li>
                            </ul>
                            </nav>                              
                        </div>
                    </div>
            
                    <div class="row">
                        <div class="col-sm-12">
                            <div id="description">
                                <h5>Room Description</h5>
                                <p><?php echo $row["long_description"];?></p>
                            </div>
                        </div>
                    </div>
                
                    <div class="row">
                        <div class="col-sm-12">
                            <div id="state">
                                <button value="<?php echo $buttonValue;?>" onclick="bookRoom()" class="btn <?php echo $buttonClass;?>" id="bookButton" style="float: right;"><?php echo $buttonValue;?></button>
                            </div>
                        </div>
                    </div>
                
                    <!-- Map  -->
                    <div class="row">
                        <div class="col-sm-12">
                            <h5><i class="fa fa-map-marker"></i> Location</h5>
                            <div id="lat" value="<?php echo $row["lat_location"];?>"></div>
                            <div id="long" value="<?php echo $row["lng_location"]?>"></div>                            
                            <div id="map"></div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-12">
                            <div id="description">
                                <h5>Add Review</h5>
                                <form action="Javascript:addReview()">
                                    <fieldset class="rating">
                                        <input type="radio" id="star5" name="rating" value="5" /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
                                        <input type="radio" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>  
                                        <input type="radio" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Meh - 3 stars"></label>
                                        <input type="radio" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>    
                                        <input type="radio" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>    
                                    </fieldset>
                                    <textarea id="reviewText" rows="4" placeholder="Review" required></textarea>
                                    <input type="submit" class="btn btn-success" value="Submit" width="25%">
                                </form>    
                            </div>
                        </div>
                    </div>
                    
                    <div id="room_id" value="<?php echo $row["room_id"];?>"></div>
                    
                    <div class="row">
                        <div class="col-sm-12">
                            <div id="description">
                                <h5>Reviews</h5>  
                                <div id="reviews">
                                    <?php
                                    $sql = 'SELECT * FROM reviews WHERE room_id='.$row["room_id"].'';
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
                                    } else {
                                        echo "<em>No reviews yet.</em>";
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               <?php              
            }
        } else {
            echo "err";
        }
    ?>



    <?php include 'footer.html'?>

    <div id="urlName" value="<?php echo $_GET['name'];?>"></div>
    <div id="urlCheckIn" value="<?php echo $_GET['checkIn'];?>"></div>
    <div id="urlCheckOut" value="<?php echo $_GET['checkOut'];?>"></div>
    
    

    <?php  include 'scripts.html' ?>
    <script>
        function myMap() {
            var latitude = document.getElementById("lat").getAttribute("value");
            var longitude = document.getElementById("long").getAttribute("value");
            
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 15,
                center: new google.maps.LatLng(latitude, longitude)
            });

            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(latitude, longitude),
                map: map
            });
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBy_tUxDPUASSljiW45soo6AM1np-Gtbkc&callback=myMap"></script>
    <script src="js/room.js"></script>
</body>

</html>