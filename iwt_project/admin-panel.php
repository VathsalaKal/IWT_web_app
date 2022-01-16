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
<div class="container">
    <div style=" height:800px;overflow-y: scroll;">
        <div class="offset-10 col-md-2 " style="margin-bottom: 5px;"  >
            <a href="add-item.php"><button type="button" class="btn btn-primary">Add New Item</button></a>
        </div>
<ul class="list-group">

    <?php
    require_once("conn.php");

    $sql = "SELECT * FROM items";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $item_id = $row["i_id"];
            echo "<a id='item-$item_id' class=\"list-group-item list-group-item-action d-flex justify-content-between align-items-center\">
                      <div class=\"image-parent\">
                          <img style='height: 250px' src=".$row["img"]." class=\"img-fluid\" alt=\"quixote\">
                      </div>
                        <div class=\"flex-column\">
                            ".$row["title"]."
                            <p><small>by Admin</small></p>
                          <span class=\"badge badge-info badge-pill\"> ".$row["quantity"]." Items in Stock</span>
                        </div>
                      <div class=\"flex-column\">
                          <button id=\"$item_id\" type=\"button\" class=\"item-edit btn btn-primary\">Edit Item</button>
                          <button id=\"$item_id\" type=\"button\" class=\"item btn btn-info\">Delete Item</button>
                      </div>
                  </a>";
        }
    } else {
        echo "0 results";
    }
    $conn->close();
    ?>
</ul>
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