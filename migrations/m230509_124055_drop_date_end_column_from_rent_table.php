<?php

use yii\db\Migration;

/**
 * Handles dropping columns from table `{{%rent}}`.
 */
class m230509_124055_drop_date_end_column_from_rent_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('{{%rent}}', 'date_end');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('{{%rent}}', 'date_end', $this->dateTime());
    }
}
