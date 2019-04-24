<?php

use yii\db\Migration;

/**
 * Class m190423_071454_products
 */
class m190423_071454_products extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('products', [
            'id' => $this->primaryKey(11)->unsigned(),
            'category_id' => $this->integer(11)->unsigned(),
            'name' => $this->string()->notNull()->unique(),
            'created_at' => $this->integer(11)->notNull()->unsigned(),
            'updated_at' => $this->integer(11)->notNull()->unsigned(),

        ], $tableOptions);

        $this->createTable('products_amount', [
            'id' => $this->primaryKey(11)->unsigned(),
            'product_id' => $this->integer(11)->unsigned(),
            'amount' => $this->integer()->notNull()->unsigned(),
            'created_at' => $this->integer(11)->notNull()->unsigned(),
            'updated_at' => $this->integer(11)->notNull()->unsigned(),

        ], $tableOptions);

        $this->createTable('product_detail', [
            'id' => $this->primaryKey(11)->unsigned(),
            'product_id' => $this->integer()->notNull(),
            'description' => $this->string()->notNull(),
            'detail' => $this->text()->notNull(),
            'created_at' => $this->integer(11)->notNull()->unsigned(),
            'updated_at' => $this->integer(11)->notNull()->unsigned(),

        ], $tableOptions);

        $this->createTable('products_category', [
            'id' => $this->primaryKey(11)->unsigned(),
            'name' => $this->string()->notNull()->unique(),
            'created_at' => $this->integer(11)->notNull()->unsigned(),
            'updated_at' => $this->integer(11)->notNull()->unsigned(),

        ], $tableOptions);


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('categories');
        $this->dropTable('product_detail');
        $this->dropTable('products_amount');
        $this->dropTable('products');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190423_071454_products cannot be reverted.\n";

        return false;
    }
    */
}
