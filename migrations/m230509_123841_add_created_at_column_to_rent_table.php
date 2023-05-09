<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%rent}}`.
 */
class m230509_123841_add_created_at_column_to_rent_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%rent}}', 'created_at', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%rent}}', 'created_at');
    }
}
