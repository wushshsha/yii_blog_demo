<?php

namespace frontend\widgets\hot;
/**
 * 热门浏览组件
 *
 */
use Yii;
use yii\bootstrap\Widget;
use yii\db\Query;
use common\models\PostExtendModel;
use common\models\PostModel;

class HotWidget extends Widget{
    public $title="";
    public $limit=6;

    public function run()
    {
        $res = (new Query())
                ->select(['a.browser','b.id','b.title'])
                ->from(['a'=>PostExtendModel::tableName()])
                ->join('LEFT JOIN', ['b'=> PostModel::tableName()],'a.post_id = b.id')
                ->where(['b.is_valid'=>PostModel::IS_VALID])
                ->orderBy(['browser'=>SORT_DESC, 'id'=>SORT_DESC])
                ->limit($this->limit)
                ->all();
        
        $data['title'] = $this->title ?:"热门浏览";
        $data['body'] = $res?:[];
        return $this->render('index',['data'=>$data]);
    }
}