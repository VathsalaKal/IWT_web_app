<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title> Register Page</title>
    <link rel="icon" href="images/mp1.png">
    <link rel="stylesheet" type="text/css" href="css/new1.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <script type="application/javascript" src="js/jquery-3.4.1.min.js"></script>
    <script type="application/javascript" src="js/bootstrap.js"></script>
    <script type="application/javascript" src="js/script.js"></script></head>

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
                <li><a href="../Login/login.html"> Login </a></li>
                <li><a target="_blank" href="register.php"> Register </a></li>
                <li><a href="conn.html"> Contact us </a></li>
                <a href="../Cart/MyCart.html"><img class="cart" src="images/cart2.png"></a>
                <input type="text" name="search" class="search" placeholder="Search here...">
                <input type="submit" name="submit" class="submit-search" value="Search">
            </ul>
        </div>
    </nav>
</header>
<!-- Registration Page PHP to save Data Into DB-->
<?php
if(isset($_POST['inputPassword4'])){
    require_once("conn.php");
    $user_address = $_POST['inputAddress'].$_POST['inputAddress2'].$_POST['inputAddress'].$_POST['inputCity'].$_POST['inputState'].$_POST['inputZip'];
    $user_password = password_hash($_POST['inputPassword4'], PASSWORD_DEFAULT);
    $sql = 'INSERT INTO users (name, mail, address, password) VALUES ("'.$_POST['inputName'].'", "'.$_POST['inputEmail4'].'", "'.$user_address.'", "'.$user_password.'")';

    if ($conn->query($sql) === TRUE) {
        print '<div class="container">
                <div class="row">
                    <div class="alert alert-success" role="alert">
                            Your account created successfully. Please <a href="login.php">Login</a> with your credentials.
                    </div>
                </div>
               </div>';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
?>

<div class="container">
    <form method="post" action="" oninput='inputPassword5.setCustomValidity(inputPassword5.value != inputPassword4.value ? "Passwords do not match." : "")'>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputName">Name</label>
                <input type="text" class="form-control" id="inputName" name="inputName" placeholder="Name">
            </div>
            <div class="form-group col-md-6">
                <label for="inputEmail4">Email</label>
                <input type="email" class="form-control" id="inputEmail4" name="inputEmail4" placeholder="Email">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputPassword4">Password</label>
                <input type="password" class="form-control" id="inputPassword4" name="inputPassword4" placeholder="Password">
            </div>
            <div class="form-group col-md-6">
                <label for="inputPassword5">Confirm password</label>
                <input type="password" class="form-control" id="inputPassword5" name="inputPassword5" placeholder="Confirm Password">
            </div>
        </div>
        <div class="form-group">
            <label for="inputAddress">Address</label>
            <input type="text" class="form-control" id="inputAddress" name="inputAddress" placeholder="1234 Main St">
        </div>
        <div class="form-group">
            <label for="inputAddress2">Address 2</label>
            <input type="text" class="form-control" id="inputAddress2" name="inputAddress2" placeholder="Apartment, studio, or floor">
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputCity">City</label>
                <input type="text" class="form-control" id="inputCity" name="inputCity">
            </div>
            <div class="form-group col-md-4">
                <label for="inputState">State</label>
                <select id="inputState" class="form-control" name="inputState">
                    <option selected>North</option>
                    <option>Southern</option>
                    <option>Western</option>
                </select>
            </div>
            <div class="form-group col-md-2">
                <label for="inputZip">Zip</label>
                <input type="text" class="form-control" id="inputZip" name="inputZip">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Sign in</button>
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
