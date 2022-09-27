<?php

namespace backend\models;

use common\models\User;
use yii\base\Model;
use yii\db\ActiveQuery;
use Yii;

class MessageUpdateForm extends Model
{
    public string $username;
    public string $text;
    public bool $has_approved;

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'username' => 'Имя',
            'text' => 'Сообщение',
            'has_approved' => 'Отображать отзыв',
        ];
    }

    /**
     * @var AdminMessage
     */
    private $_message;

    public function __construct(AdminMessage $message, $config = [])
    {
        $this->_message = $message;
        $this->username = $message->username;
        $this->text = $message->text;
        $this->has_approved = $message->has_approved;
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['username', 'text', 'has_approved'], 'required'],
//            [
//                'email',
//                'targetClass' => AdminMessage::className(),
//                'message' => Yii::t('app', 'ERROR_EMAIL_EXISTS'),
//                'filter' => ['<>', 'id', $this->_user->id],
//            ],
            [['username', 'text'], 'string'],
            ['has_approved', 'boolean'],
        ];
    }

    public function update()
    {
        if ($this->validate()) {
            $message = $this->_message;
            if (User::isRoleAdministrator(Yii::$app->user->identity->id)) {
                $message->username = $this->username;
                $message->text = $this->text;
            }
            $message->has_approved = $this->has_approved;
            return $message->save();
        } else {
            return false;
        }
    }
}
