<?php
namespace frontend\models;

use common\models\base\BaseModel;
use common\models\TagModel;

class TagForm extends BaseModel{
    public $tags;

    public function rules()
    {
        return [
            ['tags', 'required'],
            ['tags', 'each', 'rule' => ['string']],//遍历每个条目必须是字符串
        ];
    }

    /**
     * 保存标签集合
     */
    public function saveTags()
    {
        $ids = [];
        if(!empty($this->tags)){
            foreach( $this->tags as $tag){
                $ids[] = $this->_saveTag($tag);
            }
        }
        return $ids;
    }

    /**
     * 保存标签
     */
    private function _saveTag($tag)
    {
        $model = new TagModel();
        $res = $model->find()->where(['tag_name'=> $tag])->one();
        //新建标签
        if(!$res){
            $model->tag_name = $tag;
            $model->post_num = 1;
            if(!$model->save()){
                throw new \Exception("保存标签失败！");
            }
            return $model->id;
        }else{
            $res->updateCounters(['post_num' => 1]);//yii自带函数，让post_num 这个字段自加1
        }
        return $res->id;

    }
}