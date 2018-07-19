<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "TBL_COMMERCIALS".
 *
 * @property int $ad_id
 * @property string $url
 * @property string $duration
 * @property int $created_at
 * @property int $updated_at
 */
class Tblcommercials extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'TBL_COMMERCIALS';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['duration','name','hexCode'], 'required'],
            [['url'],'file','extensions' => 'mp3'],
            [['created_at', 'updated_at'], 'integer'],
            [['url'], 'string', 'max' => 255],
            [['duration'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ad_id' => 'Ad ID',
            'url' => 'Url',
            'duration' => 'Duration',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
