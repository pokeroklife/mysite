<?php
declare(strict_types=1);

use yii\db\Migration;

/**
 * Class m190410_063732_tags
 */
class m190410_063732_tags extends Migration
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

        $this->createTable('tag', [
            'id' => $this->primaryKey(11)->unsigned(),
            'name' => $this->string()->notNull()->unique(),
            'status' => $this->tinyInteger()->notNull()->defaultValue(1)->unsigned(),
            'created_at' => $this->integer(11)->notNull()->unsigned(),
            'updated_at' => $this->integer(11)->notNull()->unsigned(),

        ], $tableOptions);

        $this->createTable('news_tag', [
            'news_id' => $this->integer(11)->notNull()->unsigned(),
            'tag_id' => $this->integer(11)->notNull()->unsigned(),
            'created_at' => $this->dateTime(),
            'PRIMARY KEY(news_id, tag_id)'
        ], $tableOptions);


        $this->createIndex(
            'idx-news_tag-news_id',
            'news_tag',
            'news_id'
        );

        $this->addForeignKey(
            'fk-news_tag-news_id',
            'news_tag',
            'news_id',
            'news',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-news_tag-tag_id',
            'news_tag',
            'tag_id'
        );

        $this->addForeignKey(
            'fk-news_tag-tag_id',
            'news_tag',
            'tag_id',
            'tag',
            'id',
            'CASCADE'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-news_tag-news_id',
            'news_tag'
        );

        $this->dropIndex(
            'idx-news_tag-news_id',
            'news_tag'
        );

        $this->dropForeignKey(
            'fk-news_tag-tag_id',
            'news_tag'
        );

        $this->dropIndex(
            'idx-news_tag-tag_id',
            'news_tag'
        );

        $this->dropTable('news_tag');

        $this->dropTable('tag');
    }

}
