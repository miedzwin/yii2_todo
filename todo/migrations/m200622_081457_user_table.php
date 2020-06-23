<?php

use yii\db\Migration;

/**
 * Class m200622_081457_user_table
 */
class m200622_081457_user_table extends Migration
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
//        echo "m200622_081457_user_table cannot be reverted.\n";
//
//        return false;
//    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'password' => $this->string()->notNull(),
            'auth_key' => $this->string()->notNull(),
        ]);
    }

    /**
     * @return bool|void|null
     */
    public function down()
    {
        $this->dropTable('user');
    }
}
