<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "post_extends".
 *
 * @property int $id 自增id
 * @property int $post_id 文章id
 * @property int $browser 浏览量
 * @property int $collect 收藏量
 * @property int $praise 点赞
 * @property int $comment 评论
 */
class PostExtendModel extends \common\models\base\BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post_extends';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_id', 'browser', 'collect', 'praise', 'comment'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'post_id' => 'Post ID',
            'browser' => 'Browser',
            'collect' => 'Collect',
            'praise' => 'Praise',
            'comment' => 'Comment',
        ];
    }

    /**
     * 更新文章统计
     */
    public function upCounter($cond,$attribute, $num){
        $counter = $this->findOne($cond);
        if(!$counter){
            $this->setAttributes($cond);
            $this->$attribute = $num;
            $this->save();
        }else{
            $countData[$attribute] = $num;
            $counter->updateCounters($countData);
        }
    }
}
