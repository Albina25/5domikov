<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%price}}`.
 */
class m230423_180435_add_deposit_column_to_price_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%price}}', 'deposit', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%price}}', 'deposit');
    }
}
