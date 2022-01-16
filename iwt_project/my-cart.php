<?php
session_start();
if(isset($_GET['type']) && $_GET['type'] == 'remove'){
 unset($_SESSION['items'][$_GET['delete_id']]);
}

if(isset($_GET['item_id'])){
    $item['id'] = $_GET['item_id'];
    $item['title'] = $_GET['item_name'];
    $item['price'] = $_GET['item_price'];
    $item['img'] = $_GET['item_img'];
//session_unset($_SESSION['items']);
    if(isset($_SESSION['items'][$item['id']])){
        echo "Same Item Already there in cart";
    }else{
        $_SESSION['items'][$item['id']] = $item;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title> Home Page</title>
    <link rel="icon" href="images/mp1.png">
    <link rel="stylesheet" type="text/css" href="css/new2.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <script type="application/javascript" src="js/jquery-3.4.1.min.js"></script>
<!--    <script type="application/javascript" src="js/bootstrap.js"></script>-->
<!--    <script type="application/javascript" src="js/script.js"></script>-->
    <link rel="stylesheet" type="text/css" href="css/shopingcss.css">

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
<main>
    <!--topic -->
    <div class="topic">
        <b><h1> My Cart </h1></b>
    </div>
    <br/>

    <!--Item Detail table-->
    <div class="cart">
        <div class="cart-labels">
            <ul>
                <li class="item item-heading">Item</li>
                <li class="price">Price</li>
                <li class="quantity">Quantity</li>
                <li class="subtotal">Subtotal</li>
            </ul>
        </div>

        <?php
        $item_set ='';
        foreach ($_SESSION['items'] as $item){
            $item_set .= '<div class="cart-product">
            <div class="item">
                <div class="product-image">
                    <img src="'.$item['img'].'" class="product-frame">
                </div>
                <div class="product-details">
                    <h1><strong><span class="item-quantity">1</span> x'.$item['title'].'</strong> L</h1>
                    <p><strong> Grey 64gb </strong></p>
                    <p>Product Code - 000'.$item['id'].'</p>
                </div>
            </div>
             
            <div class="price">'.$item['price'].'</div>
            <div class="quantity">
                <input type="number" value="1" min="1" class="quantity-field">
            </div>
            <div class="subtotal">'.$item['price'].'</div>
           <div class="remove" >
                    <button id="'.$item['id'].'">Remove</button>
                </div>
        </div>';
        }
        print $item_set;
        ?>

    </div>

    <!--Checkout-->
    <aside>
        <div class="summary">
            <div class="summary-total-items"><span class="total-items"></span> Items in your Bag</div>
            <div class="summary-subtotal">
                <div class="subtotal-title">Subtotal</div>
                <div class="subtotal-value final-value" id="cart-subtotal">0.00</div>
                <div class="summary-promo hide">
                    <div class="promo-title">Promotion</div>
                    <div class="promo-value final-value" id="cart-promo"></div>
                </div>
            </div>
            <div class="summary-delivery">
                <select name="delivery-collection" class="summary-delivery-selection">
                    <option value="0" selected="selected">Select Delivery Method</option>
                    <option value="collection">Post</option>
                    <option value="first-class">DHL</option>
                </select>
            </div>
            <div class="summary-total">
                <div class="total-title">Total</div>
                <div class="total-value final-value" id="cart-total">0.00</div>
            </div>
            <div class="summary-checkout">
                <a link href="../Search/ship.html"><button class="checkout-cta">CHECKOUT</button></a>
            </div>
        </div>
    </aside>
</main>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<script type="application/javascript">
    /* Set values + misc */
    var promoCode;
    var promoPrice;
    var fadeTime = 300;

    /* Assign actions */
    $('.quantity input').change(function() {
        updateQuantity(this);
    });

    $('.remove button').click(function() {
        var del_id = $(this).attr('id');
        $.ajax({
            url: "my-cart.php",
            type: "get", //send it through get method
            data: {
                type: 'remove',
                delete_id: del_id
            },
            success: function(response) {
                //Do Something
            },
            error: function(xhr) {
                //Do Something to handle error
            }
        });

        removeItem(this);
    });

    jQuery(document).ready(function() {
        recalculateCart();
        updateSumItems();
    });


    /* Recalculate cart */
    function recalculateCart(onlyTotal) {
        var subtotal = 0;

        $('.cart-product').each(function() {
            subtotal += parseFloat($(this).children('.subtotal').text());
        });

        /* Calculate totals */
        var total = subtotal;


        /*updating deatail animation*/
        if (onlyTotal) {
            /* Update total display */
            $('.total-value').fadeOut(fadeTime, function() {
                $('#cart-total').html(total.toFixed(2));
                $('.total-value').fadeIn(fadeTime);
            });
        } else {
            /* Update summary display. */
            $('.final-value').fadeOut(fadeTime, function() {
                $('#cart-subtotal').html(subtotal.toFixed(2));
                $('#cart-total').html(total.toFixed(2));
                if (total == 0) {
                    $('.checkout-cta').fadeOut(fadeTime);
                } else {
                    $('.checkout-cta').fadeIn(fadeTime);
                }
                $('.final-value').fadeIn(fadeTime);
            });
        }
    }

    /* Update quantity */
    function updateQuantity(quantityInput) {

        var productRow = $(quantityInput).parent().parent();
        var price = parseFloat(productRow.children('.price').text());
        var quantity = $(quantityInput).val();
        var linePrice = price * quantity;

        /* Update line price display and recalc cart totals */
        productRow.children('.subtotal').each(function() {
            $(this).fadeOut(fadeTime, function() {
                $(this).text(linePrice.toFixed(2));
                recalculateCart();
                $(this).fadeIn(fadeTime);
            });
        });

        productRow.find('.item-quantity').text(quantity);
        updateSumItems();
    }

    function updateSumItems() {
        var sumItems = 0;
        $('.quantity input').each(function() {
            sumItems += parseInt($(this).val());
        });
        $('.total-items').text(sumItems);
    }

    /* Remove item from cart */
    function removeItem(removeButton) {

        var productRow = $(removeButton).parent().parent();
        productRow.slideUp(fadeTime, function() {
            productRow.remove();
            recalculateCart();
            updateSumItems();
        });
    }


</script>

</body>

</html>
