<?php

use yii\db\Migration;

/**
 * Class m220923_041826_add_users_to_user_table
 */
class m220923_041826_add_users_to_user_table extends Migration
{
    private function createAuthKey(): string
    {
        return Yii::$app->security->generateRandomString();
    }

    private function createPasswordHash(string $password): string
    {
        return Yii::$app->getSecurity()->generatePasswordHash($password);
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('{{%user}}', ['username', 'auth_key', 'password_hash', 'email', 'role', 'created_at', 'updated_at'], [
            ['Administrator', $this->createAuthKey(), $this->createPasswordHash('passAdmin'), 'admin@mail.net', 30, time(), 0],
            ['Moderator', $this->createAuthKey(), $this->createPasswordHash('passModer'), 'moder@mail.net', 20, time()+rand(100, 500), 0],
            ['User', $this->createAuthKey(), $this->createPasswordHash('passUser'), 'user@mail.net', 10, time()+rand(600, 900), 0],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->truncateTable('{{@user}}');
    }
}
