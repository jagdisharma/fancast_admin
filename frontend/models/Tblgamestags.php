<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "TBL_GAMES_TAGS".
 *
 * @property int $id
 * @property int $game_id
 * @property int $tag_id
 * @property int $created_at
 * @property int $updated_at
 */
class Tblgamestags extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'TBL_GAMES_TAGS';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['game_id', 'tag_id', 'created_at', 'updated_at'], 'required'],
            [['game_id', 'tag_id', 'created_at', 'updated_at'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'game_id' => 'Game ID',
            'tag_id' => 'Tag ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
