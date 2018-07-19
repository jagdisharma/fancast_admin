<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "TBL_USERS".
 *
 * @property int $user_id
 * @property string $username
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $password
 * @property string $image
 * @property string $broadcaster
 * @property string $description
 * @property int $followers
 * @property int $following
 * @property int $earnings
 * @property string $ssn
 * @property string $paypal
 * @property string $bank_account_number
 * @property string $routingNumber
 * @property string $deviceToken
 * @property string $deviceType
 * @property string $version
 * @property int $created_at
 * @property int $updated_at
 *
 * @property TBLADDRESS[] $tBLADDRESSes
 * @property TBLBROADCASTS[] $tBLBROADCASTSs
 * @property TBLCHANNELS[] $tBLCHANNELSs
 * @property TBLUSERFOLLOWING[] $tBLUSERFOLLOWINGs
 * @property TBLUSERFOLLOWING[] $tBLUSERFOLLOWINGs0
 * @property TBLUSERTAGS[] $tBLUSERTAGSs
 */
class Tblusers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    public static function tableName()
    {
        return 'TBL_USERS';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'email', 'password', 'broadcaster','first_name','last_name'], 'required'],
            [['username','email'],'unique'],
            ['email','email'],
            [['broadcaster'], 'string'],
            [['followers', 'following','status', 'earnings', 'created_at', 'updated_at'], 'integer'],
            [['username', 'email', 'password', 'paypal'], 'string', 'max' => 50],
            [['first_name', 'last_name', 'ssn', 'bank_account_number', 'routingNumber'], 'string', 'max' => 20],
            [['image'],'file','extensions' => 'jpg, png'],
            [['image', 'deviceToken'], 'string', 'max' => 255],
            [['description'], 'string', 'max' => 10000],
            [['deviceType', 'version'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'username' => 'Username',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'email' => 'Email',
            'password' => 'Password',
            'image' => 'Image',
            'broadcaster' => 'Broadcaster',
            'description' => 'Description',
            'followers' => 'Followers',
            'following' => 'Following',
            'earnings' => 'Earnings',
            'ssn' => 'Ssn',
            'paypal' => 'Paypal',
            'bank_account_number' => 'Bank Account Number',
            'routingNumber' => 'Routing Number',
            'deviceToken' => 'Device Token',
            'deviceType' => 'Device Type',
            'version' => 'Version',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTBLADDRESSes()
    {
        return $this->hasMany(TBLADDRESS::className(), ['user_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTBLBROADCASTSs()
    {
        return $this->hasMany(TBLBROADCASTS::className(), ['user_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTBLCHANNELSs()
    {
        return $this->hasMany(TBLCHANNELS::className(), ['user_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTBLUSERFOLLOWINGs()
    {
        return $this->hasMany(TBLUSERFOLLOWING::className(), ['user_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTBLUSERFOLLOWINGs0()
    {
        return $this->hasMany(TBLUSERFOLLOWING::className(), ['broadcaster_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTBLUSERTAGSs()
    {
        return $this->hasMany(TBLUSERTAGS::className(), ['user_id' => 'user_id']);
    }
}
