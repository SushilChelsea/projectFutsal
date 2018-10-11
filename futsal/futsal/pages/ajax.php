<?php	
    require '../includes/autoloader.php';

    // var_dump($_POST);  //$_POST have date and futsal variable from javascript     
    $total = ['6-7Am', '7-8Am', '8-9Am', '9-10Am', '10-11Am', '11-12Am', '12-1Pm', '1-2Pm', '2-3Pm', '3-4Pm', '4-5Pm', '5-6Pm', '6-7Pm', '7-8Pm'];

    $connection = new connection();
    $pdo = $connection->getConnection();

    $dbNotice = new DatabaseTable($pdo, 'notices');
    $noticeResults = $dbNotice->selectMultipleColumnName('date', $_POST['date'], 'futsal_id', $_POST['futsal_id']);
    $valid = true;
    $description;
    foreach ($noticeResults as $result) {
        if ($result['is_open'] == 'no') {
            $valid = false;
            $description = $result['description'];
            break;
        }
    }
    
    if ($valid) {
        $table = "bookings";
        $database = new DatabaseTable($pdo, $table);

        // $bookeds = $database->selectMatchedColumnName('date', $_POST['date']);
        $bookeds = $database->selectMultipleColumnName('date', $_POST['date'], 'futsal_id', $_POST['futsal_id']);
        // var_dump($bookeds); die();
        $finalArray=[];
        foreach ($bookeds as $row) {
            if (strpos($row['timing'],',')) {
                $array=explode(',',$row['timing']);
                foreach ($array as $value) {
                    $finalArray[]=$value;
                }
            } else {
                $finalArray[]=$row['timing'];
            }
        }

        echo '<div id="timing">';
            echo '<div id="block" style="margin-top: 200px;">';
                $count = 0; // positioning span element according to count number.
                /* storing the difference of two array */
                $results = array_merge(array_diff($finalArray, $total), array_diff($total, $finalArray));
                foreach ($results as $value) {
                    $count ++;
                    /* if it is first element margin-left else dont margin-left */
                    if ($count == 1 ) {
                        echo '<span style="border: 1px white solid; padding: 6px; background-color: green;">'.$value.'</span>';
                    } else if($count == 7) {
                        echo '<br>';
                        echo '<br>';
                        echo '<span style="border: 1px white solid; padding: 6px; margin-left: 5px; background-color: green;">'.$value.'</span>';
                    } else {
                        echo '<span style="border: 1px white solid; padding: 6px; margin-left: 5px; background-color: green;">'.$value.'</span>';
                    }
                }
                echo '<br>';
                echo '<br>';
                foreach ($finalArray as $book) {
                    $count ++;
                    /* if it is first element margin-left else dont margin-left */
                    if ($count == 1 ) {
                        echo '<span style="border: 1px white solid; padding: 6px; background-color: red;">'.$book.'</span>';
                    } else {
                        echo '<span style="border: 1px white solid; padding: 6px; margin-left: 5px; background-color: red;">'.$book.'</span>';
                    }				
                }
                
            echo "<p>Note: Red are booked</p>";
            echo '</div>';
        echo '</div>';
    } else {
        echo '<h3>Sorry we are off on this day! :) <br></h3>';
        echo '<center><h4>Due to: '.$description. '</h4></center>';
    }

?>
