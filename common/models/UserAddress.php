<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%user_addresses}}".
 *
 * @property int $id
 * @property string $address
 * @property string $city
 * @property string|null $state
 * @property string $coutry
 * @property string $zipcode
 * @property int $user_id
 *
 * @property User $user
 */
class UserAddress extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user_addresses}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'address', 'city', 'coutry', 'zipcode', 'user_id'], 'required'],
            [['id', 'user_id'], 'integer'],
            [['address', 'city', 'state'], 'string', 'max' => 255],
            [['coutry', 'zipcode'], 'string', 'max' => 45],
            [['id'], 'unique'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'address' => 'Address',
            'city' => 'City',
            'state' => 'State',
            'coutry' => 'Coutry',
            'zipcode' => 'Zipcode',
            'user_id' => 'User ID',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\UserQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\UserAddressQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\UserAddressQuery(get_called_class());
    }
}
