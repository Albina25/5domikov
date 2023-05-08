<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%house}}`.
 */
class m230508_092558_add_title_column_to_house_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%house}}', 'title', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%house}}', 'title');
    }
}
