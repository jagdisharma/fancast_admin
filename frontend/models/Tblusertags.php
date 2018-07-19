<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "TBL_USER_TAGS".
 *
 * @property int $id
 * @property int $user_id
 * @property int $tag_id
 * @property int $created_at
 * @property int $updated_at
 *
 * @property TBLTAGS $tag
 * @property TBLUSERS $user
 */
class Tblusertags extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'TBL_USER_TAGS';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'tag_id', 'created_at', 'updated_at'], 'required'],
            [['user_id', 'tag_id', 'created_at', 'updated_at'], 'integer'],
            [['tag_id'], 'exist', 'skipOnError' => true, 'targetClass' => TBLTAGS::className(), 'targetAttribute' => ['tag_id' => 'tag_id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => TBLUSERS::className(), 'targetAttribute' => ['user_id' => 'user_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'tag_id' => 'Tag ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTag()
    {
        return $this->hasOne(TBLTAGS::className(), ['tag_id' => 'tag_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(TBLUSERS::className(), ['user_id' => 'user_id']);
    }
}
