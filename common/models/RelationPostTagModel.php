<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "relation_post_tags".
 *
 * @property int $id 自增id
 * @property int $post_id 文章id
 * @property int $tag_id 标签id
 */
class RelationPostTagModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'relation_post_tags';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_id', 'tag_id'], 'integer'],
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
            'tag_id' => 'Tag ID',
        ];
    }

    public function getTag()
    {
        return $this->hasOne(TagModel::className(),['id' => 'tag_id']);
    }
}
