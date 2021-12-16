<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'head.html' ?>
    <link rel="stylesheet" type="text/css" href="css/profile.css">
</head>

<body>
    <!-- Include header -->
    <?php include 'header.html'?>

    <!-- Main Container -->
    <div class="container" id="mainBody">
        <div class="row">
            <!-- Side Info  -->
            <div class="col-lg-3">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6 col-lg-12 favorites">
                            <h5>Favorites <i class="fa fa-heart"></i></h5>
                            <div id="favoriteResults"></div>
                        </div>
                        <br> 
                        <div class="col-sm-6 col-lg-12 reviews">
                            <h5>Reviews <i class="fa fa-comment"></i></h5>
                            <div id="reviewResults"></div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- MAIN BODY - ROOMS -->
            <div class="col-lg-9">
                <div class="bookingHeading">
                    <h5>My Bookings</h5>
                </div>
                <!-- RESULTS HERE -->
                <div id="result"></div>
            </div>

        </div>
    </div>

    <?php include 'footer.html'?>
    <?php  include 'scripts.html' ?>
    <script src="js/profile.js"></script>
</body>

</html>