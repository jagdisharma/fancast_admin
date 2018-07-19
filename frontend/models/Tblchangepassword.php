<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "TBL_CHANGE_PASSWORD".
 *
 * @property int $id
 * @property string $token
 * @property int $user_id
 * @property int $created_at
 */
class Tblchangepassword extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'TBL_CHANGE_PASSWORD';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['token', 'user_id', 'created_at'], 'required'],
            [['user_id', 'created_at'], 'integer'],
            [['token'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'token' => 'Token',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
        ];
    }
}
