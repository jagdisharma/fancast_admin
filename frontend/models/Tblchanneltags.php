<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "TBL_CHANNEL_TAGS".
 *
 * @property int $id
 * @property int $channel_id
 * @property int $tag_id
 * @property int $created_at
 * @property int $updated_at
 *
 * @property TBLCHANNELS $channel
 * @property TBLTAGS $tag
 */
class Tblchanneltags extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'TBL_CHANNEL_TAGS';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['channel_id', 'tag_id', 'created_at', 'updated_at'], 'required'],
            [['channel_id', 'tag_id', 'created_at', 'updated_at'], 'integer'],
            [['channel_id'], 'exist', 'skipOnError' => true, 'targetClass' => TBLCHANNELS::className(), 'targetAttribute' => ['channel_id' => 'channel_id']],
            [['tag_id'], 'exist', 'skipOnError' => true, 'targetClass' => TBLTAGS::className(), 'targetAttribute' => ['tag_id' => 'tag_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'channel_id' => 'Channel ID',
            'tag_id' => 'Tag ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChannel()
    {
        return $this->hasOne(TBLCHANNELS::className(), ['channel_id' => 'channel_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTag()
    {
        return $this->hasOne(TBLTAGS::className(), ['tag_id' => 'tag_id']);
    }
}
