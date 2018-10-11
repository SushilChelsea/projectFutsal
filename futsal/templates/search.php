<section id="search">   <!-- Search Section -->
    <div class="container-fluid">   <!-- Continer-fluid div starts -->
        <div class="row" style="margin: 2rem 0 0 2rem;"> <!-- row div start -->
            <div class="col-sm-2 col-centered"></div>   <!-- Offsetting 2 column -->
            <div class="col-sm-4 description">  <!-- column starts -->
                <h4><bold class="text-primary">Search Futsal</bold>
                    <small>i.e by Futsal name or Location.</small>
                </h4>
            </div> <!-- column ends -->
            <div class="col-sm-4"> <!-- column starts -->
                <form class="form-inline" action="" method="post">
                    <div class="search-form">
                        <div class="form-group mb-2">           
                            <input type="text" class="form-control" placeholder="Search" name="searchField" required>
                            <!-- <input type="submit" name="search_button" class="btn btn-default"> -->
                        </div>
                        <button type="submit" name="search" class="btn btn-primary btn-md btn-responsive">
                            <span class="glyphicon glyphicon-search"></span> Search
                        </button>
                    </div>                      
                </form>
            </div> <!-- column ends -->
        </div> <!-- row div ends here -->
    </div>  <!-- container-fluid ends here -->
</section> <!-- Search Section end-->

<div class="search-result"> <!-- serarch-result -->
    <div class="container-fluid">
        <?php

        if (isset($_POST['search'])) {
            $searchField = strtolower($_POST['searchField']);
            $table = 'futsals';
            $database = new databasetable($pdo, $table);

            $futsals = $database->selectMatchedColumnName('location', $searchField);

            $result = $pdo->query(" SELECT * FROM $table WHERE location like '%$searchField%' OR name like '%$searchField%'");

            while ($futsal = $result->fetch()) {
                echo '<div class="row">';
                echo '<div class="col-md-4">';
                echo '<br>';
                echo '<h2 class="text-primary">' . $futsal['name'] . '</h2>';
                echo '<h4>About: ' . $futsal['description'] . '</h4>';
                echo '<h4>Email-Address: ' . $futsal['email'] . '</h4>';
                echo '<h4>Telephone No.: ' . $futsal['telephone'] . '</h4>';
                echo '<h4>Location: ' . $futsal['location'] . '</h4>';
                echo '<h4>City: ' . $futsal['city'] . '</h4>';
                echo '</div>';
                echo '<div class="col-md-4 col-centered"></div>';
                echo '<div class="col-md-4">';
                echo '<img src="../img/futsal/' . $futsal['img'] . '" class="img-responsive img-thumbnail">';
                echo '</div>';
                echo '</div>';
                echo '<hr>';
            }

        }


        ?>
    </div>    
</div><!-- serarch-result end -->