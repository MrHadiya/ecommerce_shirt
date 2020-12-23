<?php
    $banners = array();
    if($banner_list['status'] == 'true' && count($banner_list['data']) > 0 ) {
        $banners = $banner_list['data'];
    }
?>
<section class="slider">
    <div class="container">
        <div class="flexslider" id="mainslider">
            <ul class="slides">
            <?php
                foreach( $banners as $key => $value ) {
                    ?>
                <li>
                    <img src="<?php echo $baseUrl.$value->image; ?>" alt="<?php echo $value->banner_title; ?>" />
<!--                    <div class="bannerheading1">Deal of the Day</div>
                    <div class="bannerheading2">Stylish Shoes Fashion</div>
                    <div class="bannerpriceround">
                        <div class="bannerpriceroundinner">
                            <span class="oldprice">$260</span>
                            <span class="newprice">$199</span>
                            <span class="bestdeal">Best Deal</span>
                        </div>
                    </div>-->
                </li>
                    <?php
                }
            ?>
            </ul>
        </div>
    </div>
</section>
