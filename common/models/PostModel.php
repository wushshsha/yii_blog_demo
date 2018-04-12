<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use common\models\base\BaseModel;

/**
 * This is the model class for table "posts".
 *
 * @property int $id 自增id
 * @property string $title 标题
 * @property string $summary 摘要
 * @property string $content 内容
 * @property string $label_img 标签图
 * @property int $cat_id 分类id
 * @property int $user_id 用户id
 * @property string $user_name 用户名
 * @property int $is_valid 是否有效： 0----未发布，1---已发布
 * @property int $created_at 创建时间
 * @property int $updated_at 更新时间
 */
class PostModel extends BaseModel
{
    const IS_VALID = 1;//已经发布
    const NO_VALID = 0;//没有发布
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'posts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content'], 'string'],
            [['cat_id', 'user_id', 'created_at', 'updated_at'], 'integer'],
            [['title', 'summary', 'label_img', 'user_name'], 'string', 'max' => 255],
            [['is_valid'], 'integer', 'max' => 4],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '标题',
            'summary' => '简介',
            'content' => '内容',
            'label_img' => '标签图',
            'cat_id' => '分类',
            'user_id' => '用户 ID',
            'user_name' => '用户名',
            'is_valid' => '状态',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
            ]
        ];
    }

    public function getRelate()
    {
        return $this->hasMany(RelationPostTagModel::className(), ['post_id' => 'id']);
    }

    public function getExtend()
    {
        return $this->hasOne(PostExtendModel::className(),['post_id' => 'id']);
    }

    public function getCat()
    {
        return $this->hasOne(CatModel::className(),['id' => 'cat_id']);
    }
}