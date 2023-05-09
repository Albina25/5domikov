<?php

use yii\db\Migration;

/**
 * Handles dropping columns from table `{{%rent}}`.
 */
class m230509_123950_drop_date_start_column_from_rent_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('{{%rent}}', 'date_start');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('{{%rent}}', 'date_start', $this->dateTime());
    }
}
