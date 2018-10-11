<?php
    require '../includes/autoloader.php';
    $paypalUrl = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
    $paypalId = 'futsalV2@gmail.com';

    date_default_timezone_set("Asia/Kathmandu");    // make default date time of kathmandu

    $connection = new connection();     // database connecting
    $pdo = $connection->getConnection();    // storing pdo object

    $now = new DateTime('now');         // gives current date and time
    // $now->setTimezone(new DateTimeZone('Asia/Kathmandu'));  // setting current datetime object to local timezone

     $todayDate = $now->format('Y/n/j');
    // echo $todayDate.'<br>';
 
    $min = $now->format('i');      // getting minute from the current datetime
    $time = $now->format('H');      // getting hour from the current datetime
    // echo $time; die();
    /* if min is passed 30 increase hour by 2 else increase hour by 1 */
    if ($min > 30) {
        $time = $time+2;
    } else {
        $time = $time+1;
    }
   
    /* converting slot time to 24 hour formate hour */
    function convertSlotElement($slotElement) {
        if ($slotElement == 1) {
            $slotElement = 13;
        }
        if ($slotElement == 2) {
            $slotElement = 14;
        }
        if ($slotElement == 3) {
            $slotElement = 15;
        }
        if ($slotElement == 4) {
            $slotElement = 16;
        }
        if ($slotElement == 5) {
            $slotElement = 17;
        }
        if ($slotElement == 6) {
            $slotElement = 18;
        }
        if ($slotElement == 7) {
            $slotElement = 19;
        }
        return $slotElement;
    }

    /* Function that is repeated in this program multiple time */
    function doThis($pdo) {
                    
        /* check whether the checkbox is empty */
        if (empty($_POST['timing'])) {
            echo "<script> alert('Please select timing checkbox.'); </script>";
            echo "<script> window.location.replace('http://localhost/sushil/futsal-latest/public_html/index.php?page=bookings'); </script>";
        } else {
            $selectedTiming = $_POST['timing'];
            $timings = implode(",", $_POST['timing']);

            unset($_POST['submit']);    // unsetting submit key of $_POST variable
            unset($_POST['timing']);    // unsetting timing key of $_POST variable

            $_POST['timing'] = $timings;

            $table = 'bookings';
            $database = new databasetable($pdo, $table);

            $booked = $database->selectMultipleColumnName('date', $_POST['date'], 'futsal_id', $_POST['futsal_id']);
            $finalArray = [];
            foreach ($booked as $row) {
                if (strpos($row['timing'], ',')) {
                    $array = explode(',', $row['timing']);
                    foreach ($array as $value) {
                        $finalArray[] = $value;
                    }
                } else {
                    $finalArray[] = $row['timing'];
                }
            }
            if (array_intersect($finalArray, $selectedTiming)) {
                echo "<script> alert('The timing slot is already selected.'); </script>";
                echo "<script> window.location.replace('http://localhost/sushil/futsal-latest/public_html/index.php?page=bookings'); </script>";
            }
        }
    }




    if (isset($_POST['submit'])) {

        $quantity = sizeof($_POST['timing']); // count array size of timing array.

        $_POST['date'] = date("Y/n/j", strtotime($_POST['date']));  // formating date without zero eg:2018/4/7

        $dbNotice = new DatabaseTable($pdo, 'notices');
        $noticeResults = $dbNotice->selectFromThreeColumnName('date', $_POST['date'], 'futsal_id', $_POST['futsal_id'], 'is_open', 'no');

        if (sizeof($noticeResults) > 0) {
            echo "<script> alert('Booking are not available in this futsal on this day :)'); </script>";
            echo "<script> window.location.replace('http://localhost/sushil/futsal-latest/public_html/index.php?page=bookings'); </script>";
        } else {
            if ($todayDate == $_POST['date']) {
                $slots = $_POST['timing'];
                $slotArray;               // array to store the elements before - of $slots array. eg 6-7am storing 6
                foreach ($slots as $slot) {
                    $split = explode('-', $slot);
                    $slotArray[] = $split[0];
                }

                $bool = false;
                foreach ($slotArray as $slotElement) {
                    $slotElement = convertSlotElement($slotElement);
                    if ($slotElement <= $time) {
                        $bool = true;
                        break;
                    }
                }
                // echo $slotElement.'<br>';
                // echo $time; die();
                if ($bool) {
                    echo "<script> alert('Time has already passed could not book!'); </script>";
                    echo "<script> window.location.replace('http://localhost/sushil/futsal-latest/public_html/index.php?page=bookings'); </script>";
                } else {
                    doThis($pdo);
                }
            } else {
                doThis($pdo);
            }
        } 

        if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
            $_SESSION['customer_name'] = $_SESSION['firstname'];
        } else {
            echo "<script> alert('Register User Must Login to proceed!'); </script>";
            echo "<script> window.location.replace('http://localhost/sushil/futsal-latest/public_html/index.php?page=bookings'); </script>";
        }
        
        $_SESSION['futsal_id'] = $_POST['futsal_id'];
        $_SESSION['date'] = $_POST['date'];
        $_SESSION['timing'] = $_POST['timing'];
    }
    
?>

    <div class='paypaluser'>
        <?php if($_SESSION['firstname'] !== 'Suman') {  
            echo '<h3 class="text-muted">Sorry! You dont have a paypal Account.</h3>';
        } else {
            echo '<h3 class="text-muted">You have a paypal account you can book via online payment.</h3>';
        }
        ?>

    </div>

<div class="container-fluid " style="margin: 265px 0 265px 0;">
    
    <div class="row">       
        <div class="col-md-6">
            <h2>Book and pay by Paypal</h2>
            <form action="<?php 
                            if ($_SESSION['customer_name'] == 'Suman') {
                                echo $paypalUrl;
                            } else {
                                echo 'bookings';
                            }
                            ?>" method="post">

                <input type="hidden" name="business" value="<?php echo $paypalId; ?>">

                <!-- Specify a Buy Now button. -->
                <input type="hidden" name="cmd" value="_xclick">
                <input type="hidden" name="item_name" value="Booking">
                <input type="hidden" name="amount" value="50">
                <input type="hidden" name="NOSHIPPING" id="1">
                <input type="hidden" name="currency_code" value="USD">
                <input type="hidden" name="quantity" value="<?php echo $quantity; ?>">

                <!-- Specify URLs -->  
                <!-- <input type='hidden' name='cancel_return' value=''> -->
                <input type='hidden' name='return' value='http://localhost/sushil/futsal-latest/public_html/index.php?page=check'>

                <!-- Display the payment button. -->
                <input type="image" name="submit" border="0"
                src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif" alt="PayPal - The safer, easier way to pay online">
                <img alt="" border="0" width="1" height="1" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >
            </form>
        </div>

        <div class="col-md-6">
            <h2>Book and pay by cash</h2>
            <p>Temporarly book if you can arrive 1 and half hour ago and clear the cash due.</p>
            <form action="check" method="post">
                <input type="submit" class="btn btn-danger btn-sm" value="Book Now">
            </form>
        </div>
    </div>
</div>