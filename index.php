<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'head.html' ?>
    <link rel="stylesheet" type="text/css" href="css/landing.css">
</head>

<body>
    <!-- Upper Menu -->
    <?php include 'header.html' ?>

    <!-- Search Box -->
    <div class="container searchMenu">
        <form action="list.php" method="POST">
        <div class="row">
                <div class="col-sm-12">
                    <h5 id="searchQuote">Find the perfect room for you...</h5>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <select id="city" name="city">
                        <option value="">City</option>
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
                </div>
                <div class="col-md-6">
                    <select id="roomType" name="roomType">
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
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="calendarIcon"><i class="fa fa-calendar"></i></span>
                        </div>
                           <input id="checkIn" name="checkIn" type="text" class="datepicker form-control" placeholder="Check-in Date" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="calendarIcon2"><i class="fa fa-calendar"></i></span>
                        </div>
                            <input id="checkOut" name="checkOut" type="text" class="datepicker form-control" placeholder="Check-out Date" readonly>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <input type="submit" class="btn btn-success" value="Search">
                </div>
            </div>
        </form>
    </div>

    <?php include 'footer.html' ?>


    <?php  include 'scripts.html' ?>
    <script src="js/datepicker.js"></script>
</body>

</html>
