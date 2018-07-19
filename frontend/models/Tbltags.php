<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "TBL_TAGS".
 *
 * @property int $tag_id
 * @property string $name
 * @property int $p_id
 * @property int $created_at
 * @property int $updated_at
 *
 * @property TBLCHANNELTAGS[] $tBLCHANNELTAGSs
 * @property TBLUSERTAGS[] $tBLUSERTAGSs
 */
class Tbltags extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'TBL_TAGS';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['p_id'],'default','value'=>0],
            [['p_id', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 11],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'tag_id' => 'Tag ID',
            'name' => 'Name',
            'p_id' => 'Parent Tag',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTBLCHANNELTAGSs()
    {
        return $this->hasMany(TBLCHANNELTAGS::className(), ['tag_id' => 'tag_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTBLUSERTAGSs()
    {
        return $this->hasMany(TBLUSERTAGS::className(), ['tag_id' => 'tag_id']);
    }
}
