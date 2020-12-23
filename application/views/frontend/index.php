<?php
if (isset($page) && count($page) > 0) {
    //print_r($page);
}
$products = array();
if ($product_list['status'] == 'true' && count($product_list['data']) > 0) {
    $products = $product_list['data'];
}
//print_r($products);
//exit;
?>
<?php include 'include/header.php'; ?>
<!DOCTYPE html>
<html lang="en">
    <head>      
        <?php include 'include/head.php'; ?>
        <title><?php echo $meta['title']; ?></title>
        <meta name="description" content="">
        <meta name="author" content="">
    </head>
    <body>
        <header>
            <?php include 'include/top_bar.php'; ?>
            <?php include 'include/menu_bar.php'; ?>
        </header>
        <div id="maincontainer">
            <?php include 'include/slider.php'; ?>

            <section id="featured">
                <div class="container">
                    <h1 class="headingfull"><span>Products</span></h1>
                    <ul class="thumbnails">
                        <?php
                        foreach ($products as $key => $value) {
                           
                            //$productImages = json_decode($value->images, true);
                            $image = ($value->image) ? $value->image : '';
                            ?>
                            <li class="span3">
                                <a class="prdocutname" href="product/<?php echo $value->product_id; ?>"><?php echo $value->product_name; ?></a>
                                <div class="thumbnail">
                                    <span class="sale tooltip-test" >Sale</span>
                                    <a href="product/<?php echo $value->product_id; ?>"><img alt="" src="<?php echo $image; ?>"></a>
                                    <div class="caption">
                                        <div class="price pull-left">
                                            <span class="oldprice"><?php echo $value->mrp; ?></span>
                                            <span class="newprice"><?php echo $value->sp; ?></span>
                                        </div>
                                        <a class="cartadd pull-right tooltip-test" title="Add to Cart"> Add to Cart </a>
                                        <span class="links pull-left"><a class="info" href="product.html">info</a>
                                            <a class="wishlist" href="wishlist.html">wishlist</a>
                                            <a class="compare" href="compare.html">compare</a>
                                        </span>
                                    </div>
                                </div>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                </div>
            </section>
        </div>
        <?php include 'include/footer.php'; ?>
        <?php include 'include/js.php'; ?>
    </body>
</html>
