<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%rent}}`.
 */
class m230509_072628_add_email_column_to_rent_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%rent}}', 'email', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%rent}}', 'email');
    }
}
