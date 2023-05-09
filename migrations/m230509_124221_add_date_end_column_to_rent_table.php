<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%rent}}`.
 */
class m230509_124221_add_date_end_column_to_rent_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%rent}}', 'date_end', $this->date());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%rent}}', 'date_end');
    }
}
