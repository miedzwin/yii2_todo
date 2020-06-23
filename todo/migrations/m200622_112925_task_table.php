<?php

use yii\db\Migration;

/**
 * Class m200622_112925_task_table
 */
class m200622_112925_task_table extends Migration
{
//    /**
//     * {@inheritdoc}
//     */
//    public function safeUp()
//    {
//
//    }
//
//    /**
//     * {@inheritdoc}
//     */
//    public function safeDown()
//    {
//        echo "m200622_112925_task_table cannot be reverted.\n";
//
//        return false;
//    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('task', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique(),
            'content' => $this->text()->notNull(),
            'status' => $this->string()->notNull()->defaultValue('todo'),
            'user_id' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            'fk_task_user_id',
            'task',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropTable('task');
    }

}
