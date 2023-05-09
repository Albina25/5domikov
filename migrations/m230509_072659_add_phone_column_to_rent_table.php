<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%rent}}`.
 */
class m230509_072659_add_phone_column_to_rent_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%rent}}', 'phone', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%rent}}', 'phone');
    }
}
