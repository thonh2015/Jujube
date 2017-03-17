<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/plugins/colorbox/jquery.colorbox-min.js');
?>
<div class="product-detail">
    <div class="product-detail-box">
        <div class="product-detail-img clearfix">
            <div>
                <?php
                $images = $model->getImages();
                $first = reset($images);
                ?>
                <?php if ($images && count($images)) { ?>
                    <div class="product-img-item">
                        <ul>
                            <?php foreach ($images as $img) { ?>
                                <li>
                                    <a class="product-img-small cboxElement"
                                       href="<?php echo ClaHost::getImageHost() . $img['path'] . 's800_600/' . $img['name']; ?>">
                                        <img
                                            src="<?php echo ClaHost::getImageHost() . $img['path'] . 's50_50/' . $img['name']; ?>">
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php } ?>
                <div class="product-img-main">
                    <a class="product-img-small product-img-large cboxElement"
                       href="<?php echo ClaHost::getImageHost() . $first['path'] . 's800_600/' . $first['name'] ?>">
                        <img
                            src="<?php echo ClaHost::getImageHost() . $first['path'] . 's330_330/' . $first['name'] ?>">
                    </a>
                </div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="product-detail-info" id="product-detail-info">
            <h2 class="product-info-title">
                <?php echo $product['name'] ?>
            </h2>

            <div class="product-info-col1">
                <?php if ($product['price'] && $product['price'] > 0) { ?>
                    <p class="product-price">
                        <span class="product-detail-price">
                            <?php echo $product['price_text']; ?>
                        </span>
                        <?php if ($product['include_vat']) { ?>
                            <span class="price-inclue-vat">
                                (<?php echo Yii::t('product', 'product_include_vat'); ?>)
                            </span>
                        <?php } ?>
                    </p>
                <?php } else { ?>
                    <p class="product-info-price">
                        <label><?php echo Yii::t('product', 'price'); ?>:</label>
                        <span class="product-detail-price">
                            <?php echo Product::getProductPriceNullLabel(); ?>
                        </span>
                    </p>
                <?php } ?>
                <?php if ($product['price_market'] && $product['price_market'] > 0) { ?>
                    <p class="product-detail-sortdesc">
                        <span><?php echo Yii::t('product', 'oldprice'); ?>:</span>
                        <span class="old-price">
                            <?php echo $product['price_market_text']; ?>
                        </span>
                    </p>
                <?php } ?>
                <?php if ($product['price_market'] && $product['price'] && $product['price'] < $product['price_market']) { ?>
                    <p class="product-detail-saving">
                        <span><?php echo Yii::t('product', 'saveprice'); ?>:</span>
                        <span class="saving-up">
                            <?php echo $product['price_save_text']; ?>
                        </span>
                    </p>
                <?php } ?>

                <?php
                $order_products = OrderProducts::countOrderProducts($product['id']);
                if ($order_products) {
                    ?>
                    <p class="product-buy-number">
                        <i></i>
                        <span><?php echo $order_products ?> đã mua</span>

                    </p>
                <?php } ?>

                <?php
                $promotion = $model->getPromotion();
                if ($promotion && count($promotion)) {
                    ?>
                    <div class="product-gif">
                        <strong><?php echo $promotion['name']; ?></strong>

                        <div class="box-product-gif-time">
                            <span>
                                <?php echo $promotion['sortdesc']; ?>
                            </span>

                            <div class="time-product">
                                <strong>Thời gian còn:</strong>

                                <div class="time-list-product">
                                    <?php
                                    $this->widget('common.extensions.flipClock.flipClock', array(
                                        'element' => '.time-list-product',
                                        'time' => $promotion['enddate'] - time(),
                                        'language' => Yii::app()->language,
                                    ));
                                    ?>
                                </div>
                                <!--end-time-list-product-->
                            </div>
                            <!--end-time-product-->
                        </div>
                        <!--end-time-product-->
                    </div><!--end-product-gif-->
                <?php } ?>

                <p class="product-info-quantity">
                    <label><?php echo Yii::t('common', 'quantity'); ?>:</label>
                    <span class="product-detail-quantity">
                        <input type="number" name="qty" value="1" max-lenght="3" class="product_quantity"
                               id="product_quantity" style="width: 40px;" min="1" step="1"/>
                    </span>
                </p>
                <?php if ($product['product_sortdesc']) { ?>
                    <p class="product-detail-sortdesc">
                        <?php echo $product['product_sortdesc']; ?>
                    </p>
                <?php } ?>
            </div>
            <div class="purchaser">
                <a href="<?php echo Yii::app()->createUrl('/economy/shoppingcart/add', array('pid' => $model->id)); ?>"
                   class="a-btn">
                    <span class="a-btn-text">MUA HÀNG</span>
                    <span class="a-btn-icon-right"><span></span></span>
                </a>
            </div>
        </div>
    </div>
    <div class="product-detail-more">
        <div class="tab">
            <ul role="tablist" class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" role="tab" href="#home">Thông tin chung</a></li>
                <?php if ($attributesShow && count($attributesShow)) {

                    ?>

                    <?php
                    $attributesDynamic = AttributeHelper::helper()->getDynamicProduct($model, $attributesShow);
                    $count = 1;
                    foreach ($attributesDynamic as $key => $item) {

                        ?>
                        <li><a data-toggle="tab" role="tab"
                               href=<?php echo "#tab" . $count; ?>><?php echo $item['name'] ?></a></li>
                        <?php
                        $count++;
                    }
                    ?>

                <?php } ?>
            </ul>
            <div class="tab-content">
                <div id="home" class="tab-pane fade active">
                    <?php
                    echo $product['product_desc'];
                    ?>
                </div>
                <?php if ($attributesShow && count($attributesShow)) { ?>
                <?php
                $attributesDynamic = AttributeHelper::helper()->getDynamicProduct($model, $attributesShow);
                $count = 1;
                foreach ($attributesDynamic as $key => $item) {
                ?>
                <div id=<?php echo "tab" . $count; ?> class="tab-pane fade">
                    <?php echo $item['value']; ?>
                </div>
                <?php
                $count++;
                }
                ?>
                <?php } ?>
            </div>
    </div>
</div>
</div>

