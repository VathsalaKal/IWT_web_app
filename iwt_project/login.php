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

<?php
if(isset($_POST['email'])) {
    require_once("conn.php");
    $sql = 'SELECT * FROM users WHERE mail="' . $_POST['email'] . '"';
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if(password_verify ( $_POST['password'] , $row['password'])){
            session_start();
            $_SESSION["name"] = $row['name'];
            $_SESSION["email"] = $row['mail'];
            $_SESSION["uid"] = $row['uid'];
            $_SESSION["role"] = $row['role'];
            header("Refresh:0;url=index.php ");
        }else{
            print '<div class="container">
                <div class="row">
                    <div class="alert alert-danger" role="alert">
                      Invalid Password !
                    </div>
                </div>
               </div>';
        }
    }else{
        print '<div class="container">
                <div class="row">
                    <div class="alert alert-danger" role="alert">
                      Invalid Email !
                    </div>
                </div>
               </div>';
    }
    $conn->close();
}
?>

<div class="container">
    <div class="row">
        <div class="col-md-5 mx-auto">
            <div id="first">
                <div class="myform form ">
                    <div class="logo mb-3">
                        <div class="col-md-12 text-center">
                            <h1>Login</h1>
                        </div>
                    </div>
                    <form action="" method="post" name="login">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" name="email"  class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Password</label>
                            <input type="password" name="password" id="password"  class="form-control" aria-describedby="emailHelp" placeholder="Enter Password">
                        </div>
                        <div class="form-group">
                            <p class="text-center">By signing up you accept our <a href="#">Terms Of Use</a></p>
                        </div>
                        <div class="col-md-12 text-center ">
                            <button type="submit" class=" btn btn-block mybtn btn-primary tx-tfm">Login</button>
                        </div>
                        <div class="col-md-12 ">
                            <div class="login-or">
                                <hr class="hr-or">
                                <span class="span-or">or</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <p class="text-center">Don't have account? <a href="#" id="signup">Sign up here</a></p>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
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
