<?php

use yii\db\Migration;

/**
 * Class m220914_143802_object_file
 */
class m220914_143802_object_file extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%object_file}}', [
            'id' => $this->primaryKey(),
            'item_id' => $this->integer()->notNull(),
            'title' => $this->string(255)->notNull()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%object_file}}');
    }
}
