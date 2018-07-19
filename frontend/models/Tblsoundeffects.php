<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "TBL_SOUND_EFFECTS".
 *
 * @property int $sound_id
 * @property string $name
 * @property string $hexCode
 * @property string $url
 * @property int $created_at
 * @property int $updated_at
 */
class Tblsoundeffects extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'TBL_SOUND_EFFECTS';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'hexCode'], 'required'],
            [['url'],'file','extensions'=>'mp3'],
            [['created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['hexCode'], 'string', 'max' => 100],
            [['url'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'sound_id' => 'Sound ID',
            'name' => 'Name',
            'hexCode' => 'Hex Code',
            'url' => 'Url',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
