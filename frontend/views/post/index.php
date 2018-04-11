<?php

use frontend\widgets\post\PostWidget;
?>
<div class="row">
    <div class="col-lg-9">
        <?=PostWidget::widget(['limit'=>10,'page'=>true])?>
    </div>
    <div class="col-lg-3"></div>
</div>