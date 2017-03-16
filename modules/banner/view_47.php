<?php if (count($banners)) { ?>
    <div class="partner">
        <div class="container">
            <div class="row eventbox">
                <?php if ($show_widget_title) { ?>
                    <div class="col-sm-12 eventbox-title">
                        <h2><a onclick="javascript:void(0)"><?php echo $widget_title ?></a></h2>
                        <div class="line"></div>
                    </div>
                <?php } ?>
                <div id="partner-body" class="col-sm-12 partner-body" style="clear: both;">
                    <?php
                    foreach ($banners as $banner) {
                        $height = $banner['banner_height'];
                        $width = $banner['banner_width'];
                        $src = $banner['banner_src'];
                        $link = $banner['banner_link'];
                        if ($banner['banner_type'] == Banners::BANNER_TYPE_IMAGE) {
                            ?>
                            <div class="item">
                                <a href="<?php echo $link ?>" <?php echo Banners::getTarget($banner) ?>>
                                    <img src="<?php echo $src; ?>" <?php if ($height) { ?> height="<?php echo $height ?>" <?php } if ($width) { ?> width="<?php echo $width; ?>" <?php } ?> alt="<?php echo $banner['banner_name']; ?>"/>
                                </a>
                            </div>
                        <?php }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div><!--Partners-->
<?php } ?>
<script>
    $(document).ready(function () {
        
        var owl3 = $("#partner-body");
        owl3.owlCarousel({
            items: 7, //10 items above 1000px browser width
            itemsDesktop: [1000, 7], //5 items between 1000px and 901px
            itemsDesktopSmall: [900, 6], // betweem 900px and 601px
            itemsTablet: [600, 3], //2 items between 600 and 0
            itemsMobile: 2 // itemsMobile disabled - inherit from itemsTablet option
        });
    });
</script>

