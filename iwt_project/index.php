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

                <a href="my-cart.php"><img class="cart" src="images/cart2.png"></a>
                <input type="text" name="search" class="search" placeholder="Search here...">
                <input type="submit" name="submit" class="submit-search" value="Search">
            </ul>
        </div>
    </nav>
</header>

<div class="slide" style="max-width:auto">
    <img class="Slides" src="images/slide1.jpg" style="width:100%">
    <img class="Slides" src="images/slide2.jpg" style="width:100%">
    <img class="Slides" src="images/slide3.jpg" style="width:100%">
</div>

</br>
<div style="text-align:center">
    <span class="dot"></span>
    <span class="dot"></span>
    <span class="dot"></span>
</div>

<script>
    var slideIndex = 0;
    showSlides();

    function showSlides() {
        var i;
        var slides = document.getElementsByClassName("Slides");
        var dots = document.getElementsByClassName("dot");
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        slideIndex++;
        if (slideIndex > slides.length) {
            slideIndex = 1
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex - 1].style.display = "block";
        dots[slideIndex - 1].className += " active";
        setTimeout(showSlides, 3000);
    }
</script>
</div>


<!--Displaying Smasung phones-->
<div class="container">

    <?php
    require_once("conn.php");

    $sql = "SELECT * FROM items";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        $i=3;
        while($row = $result->fetch_assoc()) {
            if($i%3 == 0){
                print '<div class="row" style="margin-bottom: 5px;">';
            }
            $i++;
            $item_id = $row["i_id"];
            $item_title = $row["title"];
            $item_name = explode("-", $row["title"]);
            $item_price = $row["price"];
            $item_img =$row["img"];

            echo "<div class=\"col-md-4\">
                    <div class=\"card\">
                        <img src=".$row["img"]." alt=\"mi7\" style=\"width:100%\">
                        <div class=\"container\">
                            <h2>$item_name[0]</h2>
                            <h4>$item_name[1]</h4>
                            <p class=\"price\">Rs : ".$row["price"]."</p>
                            <p><a link href=\"../Cart/MyCart.html\">
                                    <button class=\"button\">Buy it Now</button></p>
                            </a>
                            <p><a link href=\"my-cart.php?item_id=$item_id&item_name=$item_title&item_price=$item_price&item_img=$item_img\">
                                    <button class=\"button\">Add to Cart</button></p>
                            </a>
                        </div>
                    </div>
                </div>";
            if($i%3 == 0){
                print '</div>';
            }
        }
    } else {
        echo "0 results";
    }
    $conn->close();
    ?>
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
