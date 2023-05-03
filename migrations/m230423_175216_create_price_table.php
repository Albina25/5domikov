<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%price}}`.
 */
class m230423_175216_create_price_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%price}}', [
            'id' => $this->primaryKey(),
            'house_id' => $this->integer(),
            'price_regular' => $this->integer(),
            'price_weekend' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%price}}');
    }
}
