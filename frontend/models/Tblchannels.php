<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "TBL_CHANNELS".
 *
 * @property int $channel_id
 * @property string $name
 * @property string $time
 * @property string $description
 * @property string $image
 * @property int $category
 * @property int $user_id
 * @property int $created_at
 * @property int $updated_at
 *
 * @property TBLUSERS $user
 * @property TBLCHANNELTAGS[] $tBLCHANNELTAGSs
 */
class Tblchannels extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'TBL_CHANNELS';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name','time','description','user_id'], 'required'],
            [['user_id', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 10000],
            [['image'], 'string', 'max' => 100],
            [['image'],'file','extensions' => 'jpg, png'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => TBLUSERS::className(), 'targetAttribute' => ['user_id' => 'user_id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'channel_id' => 'Channel ID',
            'name' => 'Name',
            'time' => 'Time',
            'description' => 'Description',
            'image' => 'Image',
            'category' => 'Category',
            'user_id' => 'User ID',
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
    public function getTBLCHANNELTAGSs()
    {
        return $this->hasMany(TBLCHANNELTAGS::className(), ['channel_id' => 'channel_id']);
    }
}
