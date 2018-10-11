<div class="container-fluid header"> <!-- Header Start -->
    <div class="row">   <!-- Navigation row start -->
        <div class="col-xs-12 col-md-1 col-lg-2"> <!-- Futsal Logo -->      
            <div class="col-sm-1 col-centered"></div>   <!-- Offsetting 1 column -->    
            <a href="">
                <img src="../img/png2.png" alt="logo" height="43px">
                <!-- <img src="img/futsal_logo.jpg" alt="logo" height="28px"> -->
            </a>
        </div>  <!-- Futsal Logo div Ends Here -->
        <div class="col-xs-12 col-md-7 col-lg-6"> <!-- User Form Column Starts -->
            <div class="row form">
                <div class="col-xs-12">
                    <!-- if login button is pressed check whether it is valid and change it to username and with logout buttons -->
                    <?php 
    if (isset($_POST['login'])) {
        $email = $_POST['email'];	// storing input email 
        $password = $_POST['pwd'];	// storing input password
        $table = 'users';			// table to look for
                            /* Creating database instance with users table */
        $database = new databasetable($pdo, $table);
        $result = $database->selectUnique('email', $email);	// users email column matched 

                            // var_dump($result);
                            /* checking users email and password wheter matched with the inputed vale */
        if ($result['email'] === $email and $result['password'] === $password) {
                                /* storing user info on session variable */
            $_SESSION['login'] = true;
            $_SESSION['userId'] = $result['id'];
            $_SESSION['email'] = $result['email'];
            $_SESSION['firstname'] = $result['firstname'];

        } else {
            echo "<script> alert('Either Password or Email is wrong.'); </script>";
            echo "<script> location.href='home'; </script>";
        }
    }
    if (isset($_SESSION['login']) and $_SESSION['login'] === true) {
        echo '<div class="logout">';
        echo '<span class="text-muted">Welcome ' . $_SESSION['firstname'] . '</span> &nbsp;&nbsp;';
                                    // echo '<button class="button"><span class="glyphicon glyphicon-chevron-down">Logout</span</button>';
        echo '<span class="dropdown">
                                            <button class="btn dropdown-toggle" type="button" data-toggle="dropdown">
                                            <span class="caret"></span></button>
                                            <ul class="dropdown-menu">
                                                <li><a href="logout">Logout</a></li>
                                            </ul>
                                        </span>';
        echo '</div>';
    } else {


        ?>
                    <!-- else display the form -->
                    <form class="form-inline" method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="Enter email" name="email" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Enter password" name="pwd" required>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary btn-xs" name="login" value="Log In">
                            <input type="submit" class="btn btn-primary btn-xs" name="" value="Register" data-toggle="modal" data-target="#exampleModal">
                        </div>
                    </form>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title col-xs-12" id="exampleModalLabel">
                                        
                                    </h5>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
                                        <div class="form-group">
                                            <label for="first_name">First Name:</label>
                                            <input type="text" class="form-control" id="first_name" name="firstname" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="last_name">Last Name:</label>
                                            <input type="text" class="form-control" id="last_name" name="lastname" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email:</label>
                                            <input type="email" class="form-control" id="email" name="email" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="pwd">Password:</label>
                                            <input type="password" class="form-control" id="pwd" name="password" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="sel1">Select Gender:</label>
                                            <select class="form-control" id="sel1" name="gender" required>
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="address">Address:</label>
                                            <input type="text" class="form-control" id="address" name="location" placeholder="Location eg: Baneswor" required>
                                            <br>
                                            <input type="text" class="form-control" name="city" placeholder="City" required>
                                        </div>
                                        <div class="form-group">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <input type="submit" class="btn btn-primary" name="register" value="Register">
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                </div>
                            </div>
                        </div>
                    </div>	<!-- Modal Ends Here -->
                    <?php 
} ?> <!-- php if else ends here -->
                </div>
            </div>  <!-- row form Ends Here -->
        </div> <!-- User Form Column Ends Here -->

        <div class="col-xs-12 col-md-4 col-lg-4"> <!-- Links column Starts Here -->
            <div class="row page"> <!-- Alligning all links to single row -->
                <div class="col-xs-4  col-sm-4"> <!-- home div starts -->
                    <a href="home">
                        <span class="glyphicon glyphicon-home"></span>
                        <strong> Home</strong>
                    </a>
                </div>  <!-- home div ends -->
                <div class="col-xs-4 col-sm-4"> <!-- futsal div starts -->
                    <a href="futsal">
                        <strong>Futsal</strong>
                    </a>
                </div>  <!-- futsal ends here -->
                <div class="col-xs-4 col-sm-4"> <!-- bookings div starts -->
                    <a href="bookings">
                        <strong>Bookings</strong>
                    </a>
                </div>  <!-- booking div ends -->
            </div> <!-- row page ends here -->
        </div>  <!-- Links column Ends Here -->
    </div> <!-- Row Ends Here -->    
</div> <!-- Header End -->