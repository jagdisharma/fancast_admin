<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "TBL_USER_FOLLOWING".
 *
 * @property int $id
 * @property int $user_id
 * @property int $broadcaster_id
 * @property int $created_at
 * @property int $updated_at
 *
 * @property TBLUSERS $user
 * @property TBLUSERS $broadcaster
 */
class Tbluserfollowing extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'TBL_USER_FOLLOWING';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'broadcaster_id', 'created_at', 'updated_at'], 'required'],
            [['user_id', 'broadcaster_id', 'created_at', 'updated_at'], 'integer'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => TBLUSERS::className(), 'targetAttribute' => ['user_id' => 'user_id']],
            [['broadcaster_id'], 'exist', 'skipOnError' => true, 'targetClass' => TBLUSERS::className(), 'targetAttribute' => ['broadcaster_id' => 'user_id']],
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
            'broadcaster_id' => 'Broadcaster ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(TBLUSERS::className(), ['user_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBroadcaster()
    {
        return $this->hasOne(TBLUSERS::className(), ['user_id' => 'broadcaster_id']);
    }
}
