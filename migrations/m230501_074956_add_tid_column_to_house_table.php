<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%house}}`.
 */
class m230501_074956_add_tid_column_to_house_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%house}}', 'tid', $this->primaryKey());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%house}}', 'tid');
    }
}
