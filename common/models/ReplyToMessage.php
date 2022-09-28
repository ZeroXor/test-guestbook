<?php

namespace common\models;

use Codeception\Test\DataProvider;
use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\QueryInterface;
use yii\web\IdentityInterface;
use yii\data\ActiveDataProvider;

/**
 * Message model
 *
 * @property integer $id
 * @property integer $message_id
 * @property integer $user_id
 * @property string $text
 * @property integer $created_at
 * @property integer $updated_at
 */
class ReplyToMessage extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%reply_to_message}}';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'default', 'value' => 0],
            [['id', 'message_id', 'user_id', 'created_at', 'updated_at'], 'integer'],
            [['username', 'text'], 'string'],
            [['id', 'message_id', 'user_id', 'created_at', 'updated_at'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'message_id' => 'ID сообщения',
            'user_id' => 'ID пользователя',
            'text' => 'Ответ',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата обновления',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @param int $id
     *
     * @return ActiveDataProvider
     */
    public function getRepliesToMessage(int $id): ActiveDataProvider
    {
        $query = ReplyToMessage::find()->where(['message_id' => $id]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC,
                ]
            ],
        ]);

        return $dataProvider;
    }

    /**
     * @param int $id
     *
     * @return ActiveDataProvider
     */
    public function getRepliesToUser(int $id): ActiveDataProvider
    {
        $query = ReplyToMessage::find()->where(['user_id' => $id]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC,
                ]
            ],
        ]);

        return $dataProvider;
    }

    /**
     * @return ActiveDataProvider
     */
    public function getMessagesList(): ActiveDataProvider
    {
        $query = Message::find()->where(['has_approved' => 1]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 2,
            ],
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC,
                    'id' => SORT_DESC,
                ]
            ],
        ]);

        return $dataProvider;
    }

    public function getMessages()
    {
        return $this->hasOne(Message::class, ['id' => 'message_id']);
    }
}
