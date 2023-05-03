<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%rent}}`.
 */
class m230430_140451_create_rent_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%rent}}', [
            'id' => $this->primaryKey(),
            'house_id' => $this->integer(),
            'date_start' => $this->dateTime(),
            'date_end' => $this->dateTime(),
            'price_total' => $this->integer(),
            'status' => $this->integer(),
            'payment_status' => $this->integer(),
            'created_at' => $this->dateTime(),
            'comment' => $this->text(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%rent}}');
    }
}
