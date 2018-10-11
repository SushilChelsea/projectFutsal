<?php
    require '../includes/autoloader.php';
    date_default_timezone_set("Asia/Kathmandu");    // make default date time of kathmandu

    $connection = new connection();     // database connecting
    $pdo = $connection->getConnection();    // storing pdo object

    $now = new DateTime('now');         // gives current date and time
    // $now->setTimezone(new DateTimeZone('Asia/Kathmandu'));  // setting current datetime object to local timezone
    $min = $now->format('i');      // getting minute from the current datetime
    $time = $now->format('H');      // getting hour from the current datetime
    
    /* if min is passed 30 increase hour by 2 else increase hour by 1 */
    if ($min > 30) {
        $time = $time+2;
    } else {
        $time = $time+1;
    }
    $todayDate = $now->format('Y/n/j');
    // echo $todayDate.'<br>';

    /* Function that is repeated in this program multiple time */
    function doThis($pdo) {
        $date = $_POST['date']; // storing the date from the user input form
        unset($_POST['date']);  // unsetting $_POST['date'] variable 
        $_POST['date'] = date("Y/n/j", strtotime($date)); // setting $_POST['date'] with new formatted date
                    
        /* check whether the checkbox is empty */
        if (empty($_POST['timing'])) {
            echo "<script> alert('Please select timing checkbox.'); </script>";
        } else {
            /* checkbox timing[]  is an array
            * timing[0] will have one value. eg timing[0] = 6-7Am
            * timing[1] will have another value. eg timing[1] = 7-8Am
            * making one timings variable using implode() function to store all array values into a single string 
            * now timing will have. eg timings = 6-7Am,7-8Am 
            */

            /* explode function to convert string to array */
            // $eg = explode(',' , $timings);
            // var_dump($eg);

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
            } else {
                $valid = $database->insert($_POST);
                if ($valid) {
                    echo "<script> alert('Data Inserted!'); </script>";
                } else {
                    echo "<script> alert('Not Inserted!'); </script>";
                }
            }
        }
    }

    if (isset($_POST['submit'])) {

        // $_SESSION['quantity'] = sizeof($_POST['timing']); 
        // echo $_SESSION['quantity'];
        $_POST['date'] = date("Y/n/j", strtotime($_POST['date']));  // formating date without zero eg:2018/4/7
        $dbNotice = new DatabaseTable($pdo, 'notices');
        $noticeResults = $dbNotice->selectFromThreeColumnName('date', $_POST['date'], 'futsal_id', $_POST['futsal_id'], 'is_open', 'no');

        if (sizeof($noticeResults) > 0) {
            echo "<script> alert('Booking are not available in this futsal on this day :)'); </script>";
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
                    if ($slotElement <= $time) {
                        $bool = true;
                        break;
                    }
                }
                if ($bool) {
                    echo "<script> alert('Time has already passed could not book!'); </script>";
                } else {
                    doThis($pdo);
                }
            } else {
                doThis($pdo);
            }
        }        
    }
?>
<style>
    .bookings {
        background: 
        linear-gradient(
        rgba(0, 0, 0, 1.0),
        rgba(0, 0, 0, 0.6)
        ),
        url("../img/cover.jpg");
        background-size: cover;
        /* margin: 10px 0 0 10px; */
        position: relative;
    }
    .bookings h3 {
        color: white;
        margin: 0;
        padding: 20px;
    }

    @media screen and (max-width: 768px) {
        .bookings {
            background-size: inherit;
            background-repeat: no-repeat;
            margin-top: 200px;
        }
    }
</style>
<div class="container-fluid bookings">  <!-- container-fluid starts -->
    <div class="row">
            <div class="col-md-1 col-centered"></div> <!-- offsetting 1 col -->
            <div class="col-md-5 content" style="height: 700px;">
            <h2 style="padding: 3px;">Book 1 and half hour before the local time.</h2>
                <div style="margin-top: 50px; border-radius: 10px;">
                    <form class="form-horizontal" method="post" action="paypal">
                        <div class="form-group">
                            <label for="name" class="control-label col-sm-2">Name:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="customer_name" value="<?php 
                                    if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
                                        echo $_SESSION['firstname'];
                                    }
                                ?>" disabled>
                            </div>                           
                        </div>  <!-- form-group ends -->
                        <!-- Dynamic select option for futsal -->
                        <div class="form-group">
                            <label for="sel" class="control-label col-sm-2">Futsal:</label>
                            <div class="col-sm-10">
                            <select class="form-control" id="sel" name="futsal_id">  
                                <?php
                                $table = 'futsals';
                                $database = new databasetable($pdo, $table);
                                $results = $database->selectAll();

                                foreach ($results as $result) {
                                    echo '<option value="'. $result['id'] .'">' . $result['name'] . '</option>';
                                }

                                ?>
                            </select>
                            </div>
                        </div>  <!-- form-group ends -->

                        <div class="form-group">
                            <label class="control-label col-sm-2">Date:</label>
                            <div class="col-sm-10">
                                <input id="dateInput" type="date" class="form-control" name="date" min="<?php echo date('Y-m-d'); ?>">
                            </div>     
                        </div>  <!-- form-group ends -->
                        <br>
                        <div class="row">
                            <button type="button" id="clickme" class="btn btn-success" onclick="myFunction()">Avaliable</button>
                        </div>
                        <br>
                        <br>
                        <div class="form-group">
                            <label class="control-label col-sm-2">Timing:</label>
                            <div class="col-sm-10">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label><input type="checkbox" name="timing[]" value="6-7Am"> 6-7Am </label>
                                        <label><input type="checkbox" name="timing[]" value="7-8Am"> 7-8Am </label>
                                        <label><input type="checkbox" name="timing[]" value="8-9Am"> 8-9Am </label>
                                        <label><input type="checkbox" name="timing[]" value="9-10Am"> 9-10Am </label>
                                                                               
                                    </div>
                                    <div class="col-sm-3">
                                        <label><input type="checkbox" name="timing[]" value="10-11Am"> 10-11Am </label>
                                        <label><input type="checkbox" name="timing[]" value="11-12Am"> 11-12Am </label>
                                    </div>
                                    <div class="col-sm-3">
                                        <label><input type="checkbox" name="timing[]" value="12-1Pm"> 12-1Pm </label>
                                    </div>
                                    <div class="col-sm-3">
                                        <label><input type="checkbox" name="timing[]" value="1-2Pm"> 1-2Pm </label>
                                        <label><input type="checkbox" name="timing[]" value="2-3Pm"> 2-3Pm </label>
                                        <label><input type="checkbox" name="timing[]" value="3-4Pm"> 3-4Pm </label>
                                        <label><input type="checkbox" name="timing[]" value="4-5Pm"> 4-5Pm </label>
                                        <label><input type="checkbox" name="timing[]" value="5-6Pm"> 5-6Pm </label>
                                        <label><input type="checkbox" name="timing[]" value="6-7Pm"> 6-7Pm </label>
                                        <label><input type="checkbox" name="timing[]" value="7-8Pm"> 7-8Pm </label>
                                    </div>
                                </div>
                            </div>     
                        </div>  <!-- form-group ends -->
                        <div class="form-group">
                            
                            <br>
                            <div class="row">
                                <input type="submit" name="submit" value="Submit" class="btn btn-primary">
                            </div>
                        </div>  <!-- form-group ends -->
                    </form>
                </div>
            </div>
            <div class="col-md-6 col-xs-12">
                <div class="display">
                    <div id="content">
                    </div>             
                </div>              
            </div>
    </div> <!-- row ends -->
</div>  <!-- container-fluid ends -->

<script>
    function myFunction() {
        var date = document.getElementById("dateInput").valueAsDate;
        var d = date.getDate();
        var m = date.getMonth() + 1;
        var y = date.getUTCFullYear();

        var newdate = y + "/" + m + "/" + d;

        /* Getting value from the futsal select option */
        var e = document.getElementById("sel");
        var value = e.options[e.selectedIndex].value;

        var xmlHttp = new XMLHttpRequest();
        xmlHttp.open('POST', '../pages/ajax.php', true);
        xmlHttp.onreadystatechange = function () {
            if (xmlHttp.readyState > 3) {
                //Code to run when the response is received
                var element = document.getElementById('content');
                element.innerHTML = xmlHttp.responseText;
            }
        };

        var data = new FormData();
        data.append('date', newdate);
        data.append('futsal_id', value);
        xmlHttp.send(data);
    }
</script>

<!-- when the button is clicked to hold the value in javascript button tag must be of type button
    eg <button type="button">btnName</button>
 -->