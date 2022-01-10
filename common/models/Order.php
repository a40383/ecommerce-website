<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%orders}}".
 *
 * @property int $id
 * @property float $total_price
 * @property int|null $status
 * @property string $firstname
 * @property string|null $lastname
 * @property string|null $emal
 * @property string|null $transaction_id
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int $user_id
 *
 * @property OrderAdresses[] $orderAdresses
 * @property OrderItems[] $orderItems
 * @property User $user
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%orders}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'total_price', 'firstname', 'user_id'], 'required'],
            [['id', 'status', 'created_at', 'created_by', 'user_id'], 'integer'],
            [['total_price'], 'number'],
            [['firstname', 'lastname', 'transaction_id'], 'string', 'max' => 45],
            [['emal'], 'string', 'max' => 255],
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
            'total_price' => 'Total Price',
            'status' => 'Status',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'emal' => 'Emal',
            'transaction_id' => 'Transaction ID',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'user_id' => 'User ID',
        ];
    }

    /**
     * Gets query for [[OrderAdresses]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\OrderAdressesQuery
     */
    public function getOrderAdresses()
    {
        return $this->hasMany(OrderAdresses::className(), ['order_id' => 'id']);
    }

    /**
     * Gets query for [[OrderItems]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\OrderItemsQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItems::className(), ['order_id' => 'id']);
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
     * @return \common\models\query\OrderQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\OrderQuery(get_called_class());
    }
}
