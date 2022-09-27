<?php

namespace frontend\models;

use common\models\Message;
use Yii;
use yii\base\Model;

/**
 * AddMessageForm is the model behind the add message form.
 */
class AddMessageForm extends Model
{
    public $username;
    public $message;
    public $created_at;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'message', 'created_at'], 'required'],
            [['username', 'message'], 'string'],
            [['created_at'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'username' => 'Имя',
            'message' => 'Сообщение',
            'created_at' => 'Дата создания',
        ];
    }

    public function addMessage()
    {
        $message = new Message();
        $message->username = $this->username;
        $message->text = $this->message;
        $message->has_approved = false;
        $message->created_at = $this->created_at;

        return $message->save(false);
    }
}
