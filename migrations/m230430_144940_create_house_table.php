<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%house}}`.
 */
class m230430_144940_create_house_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%house}}', [
            'id' => $this->integer(),
            'price_regular' => $this->integer(),
            'price_weekend' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%house}}');
    }
}
