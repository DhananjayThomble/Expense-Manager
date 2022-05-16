<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Ct₹l Budget</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-right">
                <?php
                    if(!isset($pageName)){ $pageName = "";}
                if (isset($_SESSION['user_id'])) {
                ?>
                    <li <?php if ($pageName == "about") {
                            echo "class='active'";
                        } ?>><a href="about_us.php"><span class="glyphicon glyphicon-info-sign"></span> About Us</a></li>
                    <li <?php if ($pageName == "change_password") {
                            echo "class='active'";
                        } ?>><a href="change_password.php"><span class="glyphicon glyphicon-cog"></span> Change Password</a></li>
                    <li <?php if ($pageName == "logout") {
                            echo "class='active'";
                        } ?>><a href="logout_script.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                    ?>
                <?php
                } else {
                ?>
                    <li <?php if ($pageName == "about") {
                            echo "class='active'";
                        } ?>><a href="about_us.php"><span class="glyphicon glyphicon-info-sign"></span> About Us</a></li>

                    <li <?php if ($pageName == "signup") {
                            echo "class='active'";
                        } ?>>
                        <a href="signup.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a>
                    </li>
                    <li <?php if ($pageName == "login") {
                            echo "class='active'";
                        } ?>><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                <?php
                }
                ?>
            </ul>
        </div>
    </div>
</div>