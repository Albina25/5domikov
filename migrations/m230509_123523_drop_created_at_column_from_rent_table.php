<?php

use yii\db\Migration;

/**
 * Handles dropping columns from table `{{%rent}}`.
 */
class m230509_123523_drop_created_at_column_from_rent_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('{{%rent}}', 'created_at');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('{{%rent}}', 'created_at', $this->dateTime());
    }
}
