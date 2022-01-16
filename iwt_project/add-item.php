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

if ( isset($_FILES["file"]["type"]) )
{
    $max_size = 500 * 1024; // 500 KB
    $destination_directory = "images/item_images/";
    $validextensions = array("jpeg", "jpg", "png");
    $temporary = explode(".", $_FILES["file"]["name"]);
    $file_extension = end($temporary);
    // We need to check for image format and size again, because client-side code can be altered
    if ( (($_FILES["file"]["type"] == "image/png") ||
            ($_FILES["file"]["type"] == "image/jpg") ||
            ($_FILES["file"]["type"] == "image/jpeg")
        ) && in_array($file_extension, $validextensions))
    {
        if ( $_FILES["file"]["size"] < ($max_size) )
        {
            if ( $_FILES["file"]["error"] > 0 )
            {
                echo "<div class=\"alert alert-danger\" role=\"alert\">Error: <strong>" . $_FILES["file"]["error"] . "</strong></div>";
            }
            else
            {
                if ( file_exists($destination_directory . $_FILES["file"]["name"]) )
                {
                    echo "<div class=\"alert alert-danger\" role=\"alert\">Error: File <strong>" . $_FILES["file"]["name"] . "</strong> already exists.</div>";
                }
                else
                {
                    $sourcePath = $_FILES["file"]["tmp_name"];
                    //$sourcePath = str_replace("\","/",$sourcePath);
                    $targetPath = $destination_directory . $_FILES["file"]["name"];
                    move_uploaded_file($sourcePath, $targetPath);
                    echo "<div class=\"alert alert-success\" role=\"alert\">";
                    echo "<p>Image uploaded successful</p>";
                    echo "<p>File Name: <a href=\"". $targetPath . "\"><strong>" . $targetPath . "</strong></a></p>";
                    echo "<p>Type: <strong>" . $_FILES["file"]["type"] . "</strong></p>";
                    echo "<p>Size: <strong>" . round($_FILES["file"]["size"]/1024, 2) . " kB</strong></p>";
                    echo "<p>Temp file: <strong>" . $_FILES["file"]["tmp_name"] . "</strong></p>";
                    echo "</div>";

                    $date_now = time();
                    require_once("conn.php");
                    $sql = 'INSERT INTO items (title, quantity, price, img, date ) VALUES ("'.$_POST['inputName'].'", '.$_POST['inputQuantity'].', '.$_POST['inputPrice'].', "'.$targetPath.'",'.$date_now.')';

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
            }
        }
        else
        {
            echo "<div class=\"alert alert-danger\" role=\"alert\">The size of image you are attempting to upload is " . round($_FILES["file"]["size"]/1024, 2) . " KB, maximum size allowed is " . round($max_size/1024, 2) . " KB</div>";
        }
    }
    else
    {
        echo "<div class=\"alert alert-danger\" role=\"alert\">Unvalid image format. Allowed formats: JPG, JPEG, PNG.</div>";
    }
}

?>

<div class="container">
    <div id="message">

    </div>
        <form id="upload-image-form" action="" method="post" enctype="multipart/form-data">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="inputName">Name</label>
                    <input type="text" class="form-control" id="inputName" name="inputName" placeholder="Item Name">
                </div>
                <div class="form-group col-md-4">
                    <label for="inputPrice">Price</label>
                    <input type="text" class="form-control" id="inputPrice" name="inputPrice" placeholder="Item Price">
                </div>
                <div class="form-group col-md-4">
                    <label for="inputQuantity">Quantity</label>
                    <input type="text" class="form-control" id="inputQuantity" name="inputQuantity" placeholder="Item Quantity">
                </div>

            </div>
            <div id="image-preview-div" style="display: none">
                <label for="exampleInputFile">Selected image:</label>
                <br>
                <img id="preview-img" src="noimage">
            </div>
            <div class="form-group">
                <input type="file" name="file" id="file" required>
            </div>
            <button class="btn btn-lg btn-primary" id="upload-button" type="submit" disabled>Add Item</button>
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