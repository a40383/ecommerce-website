<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%order_adresses}}".
 *
 * @property int $id
 * @property string $address
 * @property string|null $city
 * @property string|null $state
 * @property string|null $country
 * @property string|null $zipcode
 * @property int $order_id
 *
 * @property Orders $order
 */
class OrderAdress extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%order_adresses}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'address', 'order_id'], 'required'],
            [['id', 'order_id'], 'integer'],
            [['address', 'city', 'state'], 'string', 'max' => 255],
            [['country', 'zipcode'], 'string', 'max' => 45],
            [['id'], 'unique'],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Orders::className(), 'targetAttribute' => ['order_id' => 'id']],
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
            'country' => 'Country',
            'zipcode' => 'Zipcode',
            'order_id' => 'Order ID',
        ];
    }

    /**
     * Gets query for [[Order]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\OrdersQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Orders::className(), ['id' => 'order_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\OrderAdressQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\OrderAdressQuery(get_called_class());
    }
}
