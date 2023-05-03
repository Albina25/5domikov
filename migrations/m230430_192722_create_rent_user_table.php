<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%rent_user}}`.
 */
class m230430_192722_create_rent_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%rent_user}}', [
            'id' => $this->primaryKey(),
            'rent_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%rent_user}}');
    }
}
