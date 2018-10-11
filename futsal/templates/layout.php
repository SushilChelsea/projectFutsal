<?php 

/* Connectiong to main Database */
$connection = new connection();
$pdo = $connection->getConnection();

/* if register button is pressed get input-field data and store in database users table */
if (isset($_POST['register'])) {
    // unsetting the register key from the POST Array
	unset($_POST['register']);  
	
	$table = 'users';
	$database = new databasetable($pdo, $table);
	$database->insert($_POST);	
}

/* if bookings or paypal page is set */
if ($_GET['page'] == 'bookings' or $_GET['page'] == 'paypal') {
    require 'htmlhead.php'; // only part from <!doctype html> to <body> 
    require 'header.php'; // header section of the page

    echo '<article>';
        echo $contents;
    echo '</article>';

    require 'footer.php'; 

} else {
  
?>

    <?php require 'htmlhead.php'; // only part from <!doctype html> to <body>  ?>
    <?php require 'header.php'; // header section of the page ?>   
      
    <section id="banner"> <!-- Video Section -->
        <video autoplay loop muted playsinline src="../img/futsal_video.mp4"></video>
    </section> <!-- Video Section Ends Here -->

    <?php require 'search.php'; ?>   <!-- section for user search input and result -->

    <article>   <!-- Article Starts -->
        <?php echo $contents; ?>
    </article>  <!-- Article ends -->

    <?php require 'parallex.php'; ?>    <!-- html section showing parallex effect -->
    <?php require 'footer.php'; ?>  <!-- everything from <footer> to </html> -->

<?php 
    }   // if else statement of booking page ends here
?>