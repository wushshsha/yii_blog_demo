<?php

use frontend\widgets\post\PostWidget;
use frontend\widgets\hot\HotWidget;
use yii\helpers\Url;
use frontend\widgets\tag\TagWidget;
?>
<div class="row">
    <div class="col-lg-9">
        <?=PostWidget::widget(['limit'=>10,'page'=>true])?>
    </div>
    <div class="col-lg-3">
        <div class="panel">
            <?php if(!\Yii::$app->user->isGuest):?>    
                <a class="btn btn-success btn-block btn-post" href="<?=Url::to(['post/create'])?>">创建文章</a>
            <?php endif;?>
        </div>
        <!--热门文章-->
        <?=HotWidget::widget()?>

        <!--标签云-->
        <?=TagWidget::widget()?>

    </div>
</div>