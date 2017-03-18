<?php if (count($products)) { ?>
    <div class="product-all">
        <?php if ($show_widget_title) { ?>
            <div class="widget-title">
                <h3><?php echo $widget_title; ?></h3>
            </div>
        <?php } ?>

        <table align="center" width="100%">
            <tbody>
            <tr>
                <td><span><strong>ÔTÔ HONDA HÀ TĨNH</strong></span></td>
                <td><span><strong>SẢN PHẨM</strong></span></td>
                <td><span><strong>GIÁ XE</strong></span></td>
            </tr>
            <?php
            foreach ($products as $product) {

                ?>
                <tr>
                    <td><a href="<?php echo $product['link']; ?>"><img
                                alt="<?php echo $product['name']; ?>"
                                src="<?php echo ClaHost::getImageHost() . $product['avatar_path'] . 's200_200/' . $product['avatar_name'] ?>"/></a>
                    </td>
                    <td><a href="<?php echo $product['link']; ?>"><span><?php echo $product['name']; ?></span></a></td>
                    <td>
                        <p><span><?php echo $product['price_text']; ?></span>
                        </p>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <div class='product-page'>
            <?php
            $this->widget('common.extensions.LinkPager.LinkPager', array(
                'itemCount' => $totalitem,
                'pageSize' => $limit,
                'header' => '',
                'htmlOptions' => array('class' => 'W3NPager',), // Class for ul
                'selectedPageCssClass' => 'active',
            ));
            ?>
        </div>
    </div>
<?php } ?>