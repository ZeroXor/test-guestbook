<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%message}}`.
 */
class m220922_060502_create_message_table extends Migration
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

        $this->createTable('{{%message}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull(),
            'text' => $this->text(),
            'has_approved' => $this->boolean()->defaultValue(false),

            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->batchInsert('{{%message}}', ['username', 'text', 'has_approved', 'created_at', 'updated_at'], [
            ['Агата Кристи', 'Археолог – самый лучший муж для любой женщины: чем старше она становится, тем больший интерес у него вызывает.', true, time(), 0],
            ['Михаил Жванецкий', 'Лучше с любовью заниматься трудом, чем с трудом заниматься любовью.', true, time()+rand(1, 1000), 0],
            ['Илья Ильф', 'Еще ни один пешеход не задавил автомобиля, тем не менее недовольны почему то автомобилисты.', false, time()+rand(1001, 2000), 0],
            ['Янина Ипохорская', 'Даже самый суеверный не откажется от тринадцатой зарплаты.', true, time()+rand(2001, 3000), 0],
            ['Ашот Наданян', 'Идеальные женщины — это шахматистки: они могут часами молчать, хорошо следят за фигурами и знают много интересных позиций.', true, time()+rand(3001, 4000), 0],
            ['Михаил Задорнов', 'Мечта российских врачей — чтобы бедные никогда не болели, а богатые никогда не выздоравливали.', false, time()+rand(4001, 5000), 0],
            ['Аврелий Марков', 'Народная примета: если девочка ждет мальчика, значит она уже не девочка.', false, time()+rand(5001, 6000), 0],
            ['Чарльз Чаплин', 'Все таки жаль немого кино. Какое удовольствие было видеть, как женщина открывает рот, а голоса не слышно.', false, time()+rand(6001, 7000), 0],
            ['Вадим Зверев', 'К концу рыбалки рыбак рыбака уже не видит издалека', true, time()+rand(7001, 8000), 0],
            ['Фома Евграфович Топорищев', 'Хорошему дровосеку и кусты не преграда, и рояль не помеха!', true, time()+rand(8001, 9000), 0],
            ['Эрл Уилсон', 'Даже если вы не сможете разобрать почерк врача на рецепте, вы точно разберете аккуратно напечатанные счета за его услуги.', false, time()+rand(9001, 10000), 0],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%message}}');
    }
}
