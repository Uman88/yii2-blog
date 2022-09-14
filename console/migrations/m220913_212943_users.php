<?php

use yii\db\Migration;

/**
 * Class m220913_212943_users
 */
class m220913_212943_users extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%user}}',[
            'id'=> $this->primaryKey(),
            'role'=> $this->integer()->notNull(),
            'status'=> $this->integer()->notNull(),
            'name'=> $this->string(100)->notNull(),
            'email'=> $this->string(100)->notNull()->unique(),
            'password_hash'=> $this->string()->notNull(),
            'auth_key'=> $this->string(32)->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}
