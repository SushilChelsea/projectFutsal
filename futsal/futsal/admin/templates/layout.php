<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title; ?></title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/new.css" rel="stylesheet">
</head>

<body>

    <div class="container-fluid header"> <!-- Header Start -->
        <div class="row">   <!-- Navigation row start -->
            <div class="col-xs-12 col-md-1 col-lg-2"> <!-- Futsal Logo -->      
                <div class="col-sm-1 col-centered"></div>   <!-- Offsetting 1 column -->    
                <a href="">
                    <img src="../../img/png2.png" alt="logo" height="43px">
                    <!-- <img src="img/futsal_logo.jpg" alt="logo" height="28px"> -->
                </a>
            </div>  <!-- Futsal Logo div Ends Here -->
        
			<div class="col-sm-4 col-centered"></div> <!-- offsetting column -->
            <div class="col-xs-12 col-md-4 col-lg-4"> <!-- Links column Starts Here -->
                <div class="row page"> <!-- Alligning all links to single row -->
                    <div class="col-xs-4  col-sm-4"> <!-- home div starts -->
                        <a href="">
                            <span class="glyphicon glyphicon-home"></span>
                            <strong> Home</strong>
                        </a>
                    </div>  <!-- home div ends -->
                    <div class="col-xs-4 col-sm-4"> <!-- futsal div starts -->
                        <a href="">
                            <strong>Futsal</strong>
                        </a>
                    </div>  <!-- futsal ends here -->
                    <div class="col-xs-4 col-sm-4"> <!-- bookings div starts -->
                        <a href="">
                            <strong>Bookings</strong>
                        </a>
                    </div>  <!-- booking div ends -->
                </div> <!-- row page ends here -->
            </div>  <!-- Links column Ends Here -->
        </div> <!-- Row Ends Here -->    
    </div> <!-- Header End -->
    
    <section id="banner"> <!-- Video Section -->
        <video autoplay loop muted playsinline src="../../img/futsal_video.mp4"></video>
    </section> <!-- Video Section Ends Here -->

    <main id="content" style="margin-top: 10px;">   <!-- Main section Starts -->
		<div class="container-fluid">
			<div class=" row">
				<?php echo $contents; ?>
			</div>	<!-- row ends here -->	
		</div>	<!-- container-fluid ends here -->
    </main>  <!-- Main section ends -->

    <!-- Footer -->
    <footer style="margin-top: 40px;"> 
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12">
                    <small>&copy; Copyright 2018, Sushil Pun</small>
                </div>
            </div>
        </div>
    </footer>

</body>

</html>