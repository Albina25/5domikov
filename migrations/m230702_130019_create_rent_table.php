<?php

use yii\db\Expression;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%rent}}`.
 */
class m230702_130019_create_rent_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%rent}}', [
            'id' => $this->primaryKey(),
            'house_id' => $this->integer()->comment('Номер дома'),
            'guests' => $this->string()->comment('Количество гостей'),
            'name' => $this->string()->comment('Имя'),
            'phone' => $this->string()->comment('Телефон'),
            'email' => $this->string()->comment('Email'),
            'date_start' => $this->dateTime()->comment('Дата начала аренды'),
            'date_end' => $this->dateTime()->comment('Дата окончания аренды'),
            'price_total' => $this->integer()->comment('Итоговая цена'),
            'status' => $this->integer()->comment('Статус заявки на аренду'),
            'payment_status' => $this->integer()->comment('Статус оплаты за аренду'),
            'created_at' => $this->dateTime()->defaultValue(new Expression('NOW()'))->notNull()->comment('Дата создания'),
            'updated_at' => $this->dateTime()->comment('Дата обновления'),
            'comment' => $this->text()->comment('Комментарий к заявке на аренду'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%rent}}');
    }
}
