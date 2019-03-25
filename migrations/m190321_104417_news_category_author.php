<?php

use yii\db\Migration;

/**
 * Class m190321_104417_news_category_author
 */
class m190321_104417_news_category_author extends Migration
{
    public function init()
    {
        $this->db = 'db2';
        parent::init();
    }

    public function safeUp()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('categories', [
            'id' => $this->primaryKey()->unsigned(),
            'name' => $this->string()->notNull()->unique(),
            'status' => $this->smallInteger()->notNull()->defaultValue(1)->unsigned(),
            'created_at' => $this->integer()->notNull()->unsigned(),
            'updated_at' => $this->integer()->notNull()->unsigned(),
        ], $tableOptions);

        $this->createTable('news', [
            'id' => $this->primaryKey()->unsigned(),
            'author_id' => $this->integer()->notNull()->unsigned(),
            'name' => $this->string()->notNull()->unique(),
            'short_description' => $this->string()->notNull(),
            'text' => $this->text()->notNull(),
            'status' => $this->smallInteger()->notNull()->defaultValue(1)->unsigned(),
            'visits' => $this->integer(11)->notNull()->unsigned(),
            'created_at' => $this->integer()->notNull()->unsigned(),
            'updated_at' => $this->integer()->notNull()->unsigned(),
        ], $tableOptions);

        $this->createTable('author', [
            'id' => $this->primaryKey()->unsigned(),
            'name' => $this->string()->notNull(),
            'last_name' => $this->string()->notNull(),
            'created_at' => $this->integer()->notNull()->unsigned(),
            'updated_at' => $this->integer()->notNull()->unsigned(),
        ], $tableOptions);

        // creates index for column `tag_id`
        $this->createIndex(
            'idx-news-author_id',
            'news',
            'author_id'
        );

        // add foreign key for table `tag`
        $this->addForeignKey(
            'fk-news-author_id',
            'author',
            'id',
            'news',
            'author_id',
            'CASCADE'
        );

        $this->createTable('categories_news', [
            'categories_id' => $this->integer()->notNull()->unsigned(),
            'news_id' => $this->integer()->notNull()->unsigned(),
            'PRIMARY KEY(categories_id, news_id)',
        ], $tableOptions);

        $this->createIndex(
            'idx-categories_news-categories_id',
            'categories_news',
            'categories_id'
        );

        // add foreign key for table `post`
        $this->addForeignKey(
            'fk-categories-id',
            'categories',
            'id',
            'categories_news',
            'categories_id',
            'CASCADE'
        );

        // creates index for column `tag_id`
        $this->createIndex(
            'idx-categories_news-news_id',
            'categories_news',
            'news_id'
        );

        // add foreign key for table `tag`
        $this->addForeignKey(
            'fk-news-id',
            'news',
            'id',
            'categories_news',
            'news_id',
            'CASCADE'
        );





    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190321_104417_news_category_author cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190321_104417_news_category_author cannot be reverted.\n";

        return false;
    }
    */
}
