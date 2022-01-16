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
<?php
require_once("conn.php");

$item_id = $_GET['item_id'];
if(isset($_POST['inputName']) || isset($_POST['inputPrice']) || isset($_POST['inputQuantity'])){
    $item_name = $_POST['inputName'];
    $item_price = $_POST['inputPrice'];
    $item_quantity = $_POST['inputQuantity'];

    $sql = 'UPDATE items SET title="'.$item_name.'", quantity = "'.$item_quantity.'", price = "'.$item_price.'"  WHERE i_id="'.$item_id.'"';
    if ($conn->query($sql) === TRUE) {
        print '<div class="container">
                <div class="row">
                    <div class="alert alert-success" role="alert">
                            Item Updated successfully.
                    </div>
                </div>
               </div>';
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
$sql = 'SELECT * FROM items WHERE i_id="'.$item_id.'"';
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $name = $row['title'];
    $price = $row['price'];
    $quantity = $row['quantity'];
}
$conn->close();
?>
<div class="container">
    <div id="message">

    </div>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="inputName">Name</label>
                <input type="text" class="form-control" id="inputName" name="inputName" value="<?php print $name;?>" >
            </div>
            <div class="form-group col-md-4">
                <label for="inputPrice">Price</label>
                <input type="text" class="form-control" id="inputPrice" name="inputPrice" value="<?php print $price;?>">
            </div>
            <div class="form-group col-md-4">
                <label for="inputQuantity">Quantity</label>
                <input type="text" class="form-control" id="inputQuantity" name="inputQuantity" value="<?php print $quantity;?>">
            </div>

        </div>

        <button class="btn btn-lg btn-primary" id="upload-button" type="submit" >Update Item</button>
    </form>

    <br>
    <div class="alert alert-info" id="loading" style="display: none;" role="alert">
        Uploading image...
        <div class="progress">
            <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
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