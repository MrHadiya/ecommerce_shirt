<?php
//if( isset($meta) && count($meta) > 0 ) {
    //print_r($meta);
//}
//echo '<br>';
//echo '<br>';
//echo '<br>';
//print_r($product_info);
//echo '<br>';
//echo count($product_info);
//exit;
$productDetails = array();
if($product_info['status'] == 'true' && !empty($product_info['data']) ) {
    $productDetails = $product_info['data'];
}
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
        <section id="product">
            <div class="container">
                <div class="row">
                    <div class="span5">
                        <ul class="thumbnails mainimage">
                        <?php
                            $productImages = $productDetails->images;
                            foreach( $productImages as $key => $value ) {
                                ?>
                            <li class="span5">
                                <a  rel="position: 'inside' , showTitle: false, adjustX:-4, adjustY:-4" class="thumbnail cloud-zoom" href="<?php echo $baseUrl.$value->image; ?>">
                                    <img alt="" src="<?php echo $baseUrl.$value->image; ?>">
                                </a>
                            </li>
                                <?php
                            }
                        ?>
                        </ul>
                        <span>Mouse move on Image to zoom</span>
                        <ul class="thumbnails mainimage">
                        <?php
                            foreach( $productImages as $key => $value ) {
                                ?>
                            <li class="producthtumb">
                                <a class="thumbnail" href="#">
                                    <img  src="<?php echo $baseUrl.$value->image; ?>" alt="">
                                </a>
                            </li>
                                <?php
                            }
                        ?>
                        </ul>
                    </div>
                    <div class="span7">
                        <div class="row">
                            <div class="span7">
                                <h1 class="productname"><span class="bgnone"><?php echo $productDetails->product_name; ?></span></h1>
                                <div class="productprice">
                                    <div class="proldprice"><?php echo $productDetails->variants[0]->mrp; ?></div>
                                    <div class="prnewprice"><?php echo $productDetails->variants[0]->sp; ?></div>
                                </div>
                                <div class="quantitybox">
                                    <select class="selectsize">
                                    <?php
                                        foreach( $productDetails->variants as $key => $value ) {
                                            echo '<option value="'.$value->size_id.'">'.$value->size_title.'</option>';
                                        }
                                    ?>
                                    </select>
                                    <select class="selectqty">
                                    <?php
                                        foreach( $productDetails->variants as $key => $value ) {
                                            echo '<option value="'.$value->color_id.'">'.$value->color_name.'</option>';
                                        }
                                    ?>
                                    </select>
                                    <a class="btn btn-success pull-left" href="#">Add to Cart</a>
                                    <div class="links  productlinks">
                                        <a class="wishlist" href="wishlist.html">wishlist</a>
                                        <a class="compare" href="compare.html">compare</a>
                                    </div>
                                </div>
                                <div class="productdesc">
                                    <ul class="nav nav-tabs" id="myTab">
                                        <li class="active"><a href="#description">Description</a></li>
                                        <li><a href="#specification">Specification</a></li>
                                        <li><a href="#review">Review</a></li>
                                        <li><a href="#producttag">Product Tags</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="description">
                                            <?php echo $productDetails->description; ?>
                                        </div>
                                        <div class="tab-pane " id="specification">
                                            <?php echo $productDetails->specification; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <?php include 'include/footer.php'; ?>
    <?php include 'include/js.php'; ?>
</body>
</html>
