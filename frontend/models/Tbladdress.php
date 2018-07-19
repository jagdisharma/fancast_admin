<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "TBL_ADDRESS".
 *
 * @property int $address_id
 * @property int $user_id
 * @property string $street_address
 * @property string $city
 * @property string $zip_code
 * @property int $created_at
 * @property int $updated_at
 *
 * @property TBLUSERS $user
 */
class Tbladdress extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'TBL_ADDRESS';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'street_address', 'city', 'zip_code', 'created_at', 'updated_at'], 'required'],
            [['user_id', 'created_at', 'updated_at'], 'integer'],
            [['street_address'], 'string', 'max' => 1000],
            [['city'], 'string', 'max' => 50],
            [['zip_code'], 'string', 'max' => 20],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => TBLUSERS::className(), 'targetAttribute' => ['user_id' => 'user_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'address_id' => 'Address ID',
            'user_id' => 'User ID',
            'street_address' => 'Street Address',
            'city' => 'City',
            'zip_code' => 'Zip Code',
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
}
