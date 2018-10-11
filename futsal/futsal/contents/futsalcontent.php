<?php
    require '../includes/autoloader.php';
    
    // database connection
    $connection = new Connection();
    $pdo = $connection->getConnection();
?>

<div class="container-fluid">

    <?php  
            $table = 'futsals';
            $database = new DatabaseTable($pdo, $table);

            $futsals = $database->selectAll();
            // var_dump($futsals);
            foreach ($futsals as $futsal) {
                echo '<div class="row">';
                    echo '<div class="col-md-4">';
                        echo '<br>';
                        echo '<h2 class="text-primary">'.$futsal['name'].'</h2>';
                        echo '<h4 class="text-muted">About: ' . $futsal['description'] . '</h4>';
                        echo '<h4 class="text-muted">Email-Address: '.$futsal['email'].'</h4>';
                        echo '<h4 class="text-muted">Telephone No.: ' . $futsal['telephone'] . '</h4>';
                        echo '<h4 class="text-muted">Location: ' . $futsal['location'] . '</h4>';
                        echo '<h4 class="text-muted">City: ' . $futsal['city'] . '</h4>';
                    echo '</div>';
                    echo '<div class="col-md-4 col-centered"></div>';
                    echo '<div class="col-md-4">';
                        echo '<img src="../img/futsal/'.$futsal['img']. '" class="img-responsive img-thumbnail">';
                    echo '</div>';
                echo '</div>';
                echo '<hr>';
            }   
    ?>    
</div>