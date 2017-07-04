<?php

use yii\db\Migration;

/**
 * Handles the creation of table `news`.
 */
class m170517_153522_create_news_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('news', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'text' => $this->text()->notNull(),
            'img' => $this->string(255)->notNull(),
            'date' => $this->date()->notNull(),
            'flag' => $this->integer(1),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('news');
    }
}
