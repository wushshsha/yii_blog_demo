<?php
namespace frontend\widgets\chat;

use Yii;
use yii\bootstrap\Widget;
use frontend\models\FeedForm;

class ChatWidget extends Widget
{
    public function run()
    {
        $feed = new FeedForm();
        $data['feed'] = $feed->getList();
        return $this->render("index", ['data'=>$data]);
    }


}