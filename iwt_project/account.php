<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title> Home Page</title>
    <link rel="icon" href="images/mp1.png">
    <link rel="stylesheet" type="text/css" href="css/new1.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <script type="application/javascript" src="js/jquery-3.4.1.min.js"></script>
    <script type="application/javascript" src="js/bootstrap.js"></script>
    <script type="application/javascript" src="js/script.js"></script>
</head>

<body>

<header>
    <div class="headerlogo">
        <a href="index.php"><img alt="vp" src="images/mp1.png"></a>
        <h1 class='heading'>MINCO MOBILE STORE</h1>
    </div>
    <nav>
        <div>
            <ul class="navbar">
                <li><a href="index.php"> Home </a></li>
                <?php  if(isset($_SESSION['email'])){ ?>
                    <li><a href="account.php"> My Account </a></li>
                    <li><a href="conn.html"> Contact us </a></li>
                    <?php  if(isset($_SESSION['role']) && $_SESSION['role'] == 0){ ?>
                        <li><a href="admin-panel.php"> Admin Panel </a></li>
                    <?php }?>
                    <li><a href="logout.php"> LogOut </a></li>
                <?php       }else {?>
                    <li><a href="login.php"> Login </a></li>
                    <li><a target="_blank" href="register.php"> Register </a></li>
                    <li><a href="conn.html"> Contact us </a></li>
                <?php       }?>

                <a href="../Cart/MyCart.html"><img class="cart" src="images/cart2.png"></a>
                <input type="text" name="search" class="search" placeholder="Search here...">
                <input type="submit" name="submit" class="submit-search" value="Search">
            </ul>
        </div>
    </nav>
</header>

<!--Get user details from DB -->
<?php
require_once("conn.php");
$user_id = $_SESSION["uid"];
$sql = 'SELECT * FROM users WHERE uid="'.$user_id.'"';
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
}
if(!empty($_POST['currentpassword']) && !empty($_POST['inputPassword4'])){
    if(password_verify ( $_POST['currentpassword'] , $row['password'])){
        $user_password = password_hash($_POST['inputPassword4'], PASSWORD_DEFAULT);
        $sql = 'UPDATE users SET password="'.$user_password.'" WHERE uid= "'.$user_id.'"';
        if ($conn->query($sql) === TRUE) {
            print '<div class="container">
                <div class="row">
                    <div class="alert alert-success" role="alert">
                            Your password reset successfully.
                    </div>
                </div>
               </div>';
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }else{
        print '<div class="container">
                <div class="row">
                    <div class="alert alert-danger" role="alert">
                      Invalid Current Password !
                    </div>
                </div>
               </div>';

    }
}
if(isset($_POST['inputName']) || isset($_POST['inputEmail4']) || isset($_POST['inputAddress'])){
    $user_name = $_POST['inputName'];
    $user_email = $_POST['inputEmail4'];
    $user_address = $_POST['inputAddress'];

    $sql = 'UPDATE users SET name="'.$user_name.'", mail = "'.$user_email.'", address = "'.$user_address.'"  WHERE uid="'.$user_id.'"';
    if ($conn->query($sql) === TRUE) {
        print '<div class="container">
                <div class="row">
                    <div class="alert alert-success" role="alert">
                            Your Profile Updated successfully.
                    </div>
                </div>
               </div>';
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
$sql = 'SELECT * FROM users WHERE uid="'.$user_id.'"';
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $name = $row['name'];
    $email = $row['mail'];
    $address = $row['address'];
}
$conn->close();
?>

<div class="container">
    <form method="post" action="" oninput='inputPassword5.setCustomValidity(inputPassword5.value != inputPassword4.value ? "Passwords do not match." : "")'>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputName">Name</label>
                <input type="text" class="form-control" id="inputName" name="inputName" value="<?php print $name;?>">
            </div>
            <div class="form-group col-md-6">
                <label for="inputEmail4">Email</label>
                <input type="email" class="form-control" id="inputEmail4" name="inputEmail4" value="<?php print $email;?>">
            </div>
        </div>
        <div class="form-group">
            <label for="inputAddress">Address</label>
            <input type="text" class="form-control" id="inputAddress" name="inputAddress" value="<?php print $address;?>">
        </div>
        <p>Fill if you want to reset your password.</p>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="currentpassword">Current Password</label>
                <input type="password" class="form-control" id="currentpassword" name="currentpassword" placeholder="Current Password">
            </div>
            <div class="form-group col-md-4">
                <label for="inputPassword4">Password</label>
                <input type="password" class="form-control" id="inputPassword4" name="inputPassword4" placeholder="New Password">
            </div>
            <div class="form-group col-md-4">
                <label for="inputPassword5">Confirm password</label>
                <input type="password" class="form-control" id="inputPassword5" name="inputPassword5" placeholder="Confirm Password">
            </div>
        </div>


        <button type="submit" class="btn btn-primary">Update Details</button>
    </form>
</div>


<footer class="footer">
    <!--div class="col-md-12" style="background-color: #fff;"-->
    <table class="foot" style="width: 100%;">
        <tbody>
        <tr>
            <td alt=""/>
            </span><strong> Flagship Store</strong><br>288, Kandy road, Malabe.</td>
            <td alt=""/>
            </span><strong>Island wide Delivery</strong><br>Same day delivery and <br>next day delivery available<br>
            for selected products</td>
            <td alt=""/>
            </span><strong>Cash on Delivery </strong><br>Available for items upto <br>Rs.50,000</td>
            <td alt=""/>
            </span><strong>24/7 Help Center</strong></td>
            <td alt=""/>
            </span><strong>Easy instalments</strong><br>Pay for your orders <br>in monthly instalments, <br>completely
            online.</td>
            <td style="text-align: center; padding-top: 15px;"><a style="cursor: pointer;"
                                                                  href="https://play.google.com/store/apps/details?id=com.infibeam.infibeamapp&amp;referrer=utm_source%3Demail"><img
                        src="https://cf-catman.infibeam.net/img/html_widget_images/8841726/c974079d3355f_googleplay.png.999xx.png"
                        alt=""/></a></td>
        </tr>
        </tbody>
    </table>

    <h3><a href="https://login.yahoo.com"> mincomobile@yahoo.com </a></h3>

    <!--**********<div class="col-md-12"><hr /></div><div id="social_sites"><span style="float: left; margin-left: 70px;">Stay Connected</span>-->
    <div style="float: right;"><span class="social"><a title="Facebook" href="https://www.facebook.com/infibeam"
                                                       rel="nofollow" target="_blank"><img
                    src="https://cf-catman.infibeam.net/img/html_widget_images/8841726/a624c15a2b8b6_facebook.png.999xx.png"
                    alt="Facebook"/></a></span> <span class="social"><a title="Twitter"
                                                                        href="https://twitter.com/infibeam"
                                                                        rel="nofollow" target="_blank"><img
                    src="https://cf-catman.infibeam.net/img/html_widget_images/8841726/addfb7c6ff75c_twitter.png.999xx.png"
                    alt=""/></a></span> <span class="social"><a title="Infibeam - Blog"
                                                                href="http://blog.infibeam.com/"
                                                                target="_blank"><img
                    src="https://cf-catman.infibeam.net/img/html_widget_images/8841726/2a804b6754119_blog.png.999xx.png"
                    alt=""/></a></span> <span class="social"><a title="Google Plus"
                                                                href="https://plus.google.com/+infibeam/"
                                                                target="_blank"><img
                    src="https://cf-catman.infibeam.net/img/html_widget_images/8841726/609598239f0ff_gplus.png.999xx.png"
                    alt=""/></a></span></div>
    <!--/div-->
</footer>
</body>
</html>