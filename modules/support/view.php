<div class="panel panel-default categorybox">
    <?php if ($show_widget_title) { ?>
    <div class="panel-heading">
        <h3><i class="fa fa-user-circle-o"></i>&nbsp;&nbsp;<?php echo $widget_title; ?></h3>
    </div>
    <?php } ?>
    <div class="panel-body">
        <ul class="menu menu-list">
            <li class="sp">
                <div class="support-item"> 
                    <?php
                    if ($data && count($data)) {
                        ?>
                        <?php
                        $i = 0;
                        foreach ($data as $support) {
                            $i++;
                            if ($i > $limit)
                                break;
                            Yii::app()->controller->renderPartial('//modules/support/type_' . $support['type'], array('data' => $support));
                        }
                        ?>
                    <?php } ?>
                </div>
            </li>
        </ul>
    </div>
</div>
