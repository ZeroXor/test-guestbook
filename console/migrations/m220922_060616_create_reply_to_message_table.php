<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%reply_to_message}}`.
 */
class m220922_060616_create_reply_to_message_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%reply_to_message}}', [
            'id' => $this->primaryKey(),
            'message_id' => $this->integer(11)->notNull(),
            'user_id' => $this->integer(11)->notNull(),
            'text' => $this->text(),

            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey(
            '{{%fk-reply_to_message-message_id}}',
            '{{%reply_to_message}}',
            'message_id',
            '{{%message}}',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            '{{%fk-reply_to_message-user_id}}',
            '{{%reply_to_message}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('{{%fk-reply_to_message-user_id}}', '{{%reply_to_message}}');
        $this->dropForeignKey('{{%fk-reply_to_message-message_id}}', '{{%reply_to_message}}');

        $this->dropTable('{{%reply_to_message}}');
    }
}
