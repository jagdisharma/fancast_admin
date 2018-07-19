<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "TBL_BROADCASTS".
 *
 * @property int $id
 * @property int $user_id
 * @property int $game_id
 * @property int $created_at
 * @property int $updated_at
 *
 * @property TBLGAMES $game
 * @property TBLUSERS $user
 */
class Tblbroadcasts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'TBL_BROADCASTS';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'game_id', 'created_at', 'updated_at'], 'required'],
            [['user_id', 'game_id', 'created_at', 'updated_at'], 'integer'],
            [['game_id'], 'exist', 'skipOnError' => true, 'targetClass' => TBLGAMES::className(), 'targetAttribute' => ['game_id' => 'game_id']],
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
            'game_id' => 'Game ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGame()
    {
        return $this->hasOne(TBLGAMES::className(), ['game_id' => 'game_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(TBLUSERS::className(), ['user_id' => 'user_id']);
    }
}
