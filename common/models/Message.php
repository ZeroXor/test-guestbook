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
 * @property string $username
 * @property string $text
 * @property boolean $has_approved
 * @property integer $created_at
 * @property integer $updated_at
 */
class Message extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%message}}';
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
            [['id', 'created_at', 'updated_at'], 'integer'],
            [['username', 'text'], 'string'],
            ['has_approved', 'boolean'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'username' => 'Имя',
            'text' => 'Сообщение',
            'has_approved' => 'Опубликовано',
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
}
