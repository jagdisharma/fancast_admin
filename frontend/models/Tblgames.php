<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "TBL_GAMES".
 *
 * @property int $game_id
 * @property string $team1
 * @property string $team2
 * @property int $time
 * @property string $image
 * @property string $category
 * @property int $created_at
 * @property int $updated_at
 *
 * @property TBLBROADCASTS[] $tBLBROADCASTSs
 */
class Tblgames extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'TBL_GAMES';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['team1','team2','time'], 'required'],
            [['image'],'file','extensions' => 'jpg, png'],
            [['created_at', 'updated_at'], 'integer'],
            [['team1', 'team2'], 'string', 'max' => 112],
            [['image'], 'string', 'max' => 100],
            [['category'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'game_id' => 'Game ID',
            'team1' => 'Team1',
            'team2' => 'Team2',
            'time' => 'Time',
            'image' => 'Image',
            'category' => 'Category',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTBLBROADCASTSs()
    {
        return $this->hasMany(TBLBROADCASTS::className(), ['game_id' => 'game_id']);
    }
}
