<?php

use yii\db\Migration;

/**
 * Class m220914_143829_post
 */
class m220914_143829_post extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%post}}', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer()->notNull(),
            'status' => $this->integer()->notNull(),
            'viewed' => $this->integer()->notNull(),
            'title' => $this->string(255)->notNull(),
            'description' => $this->string(255)->notNull(),
            'content' => $this->text()->notNull(),
            'author' => $this->string(100)->notNull(),
            'img_id' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        echo "m220914_143829_post cannot be reverted.\n";

        return false;
    }
}
