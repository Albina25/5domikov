<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%house}}`.
 */
class m230501_080012_add_deposit_column_to_house_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%house}}', 'deposit', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%house}}', 'deposit');
    }
}
