<?php

use yii\db\Migration;

/**
 * Class m190413_091710_create_test
 */
class m190413_091710_create_test extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('test', [
            'id' => $this->primaryKey(),
            'price' => $this->integer()->defaultValue(100)->notNull(),
            'about' => $this->string(),
            'txt' => $this->string(50),
            'article' => $this->text(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->$this->dropTable('test');
        // выполним откат миграции
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190413_091710_create_test cannot be reverted.\n";

        return false;
    }
    */
}
