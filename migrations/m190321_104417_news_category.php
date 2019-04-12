<?php
declare(strict_types=1);

use yii\db\Migration;

/**
 * Class m190321_104417_news_category_author
 */
class m190321_104417_news_category_author extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('categories', [
            'id' => $this->primaryKey(11)->unsigned(),
            'name' => $this->string(255)->notNull()->unique(),
            'status' => $this->tinyInteger()->notNull()->defaultValue(1)->unsigned(),
            'created_at' => $this->integer(11)->notNull()->unsigned(),
            'updated_at' => $this->integer(11)->notNull()->unsigned(),
        ], $tableOptions);

        $this->createTable('news', [
            'id' => $this->primaryKey(11)->unsigned(),
            'author_id' => $this->integer(11)->notNull()->unsigned(),
            'categories_id' => $this->integer(11)->notNull()->unsigned(),
            'name' => $this->string(255)->notNull()->unique(),
            'description' => $this->string(255)->notNull(),
            'text' => $this->text()->notNull(),
            'image' => $this->string(255)->notNull(),
            'status' => $this->tinyInteger()->notNull()->defaultValue(1)->unsigned(),
            'visits' => $this->integer(11)->notNull()->unsigned(),
            'created_at' => $this->integer(11)->notNull()->unsigned(),
            'updated_at' => $this->integer(11)->notNull()->unsigned(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190321_104417_news_category_author cannot be reverted.\n";

        return false;
    }
}
