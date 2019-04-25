<?php
declare(strict_types=1);

namespace app\modules\blog\behaviors;

use app\modules\blog\models\Articles;
use app\modules\blog\models\ArticlesTag;
use app\modules\blog\models\Tag;
use yii\base\Behavior;
use yii\db\ActiveRecord;
use yii\db\Exception;

class TagsBehavior extends Behavior
{
    public function __construct(array $config = [])
    {
        parent::__construct($config);
    }

    public function events(): array
    {
        return [
            ActiveRecord::EVENT_AFTER_INSERT => 'create',
            ActiveRecord::EVENT_AFTER_UPDATE => 'update',
        ];
    }
    /**
     * @return void
     * @throws Exception
     */
    public function create(): void
    {
        try {
            $tags = $this->getRelationTags();
            ArticlesTag::createRelationArticleTags($tags, $this->owner->id);
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * @return void
     * @throws Exception
     */
    public function update(): void
    {
        try {
            ArticlesTag::deleteArticleTags($this->owner->id);
            $this->create();

        } catch (Exception $e) {
            throw $e;
        }
    }
    /**
     * @return Tag[]
     * @throws Exception
     */
    private function getRelationTags(): array
    {
        /** @var Articles $article */
        $article = $this->owner;
        $tags = Tag::getTags($article->articleTags);
        $newTags = $this->getNewTags($tags, $article->articleTags);
        foreach ($newTags as $name) {
            if (($tag = Tag::createTag($name)) === null) {
                throw new Exception('тэги не сохранились');
            }
            $tags[] = $tag;
        }

        return $tags;
    }

    private function getNewTags(array $oldTags, array $newTags): array
    {
        $result = array_flip($newTags);
        foreach ($oldTags as $tag) {
            if (isset($result[$tag->name])) {
                unset($result[$tag->name]);
            }
        }
        return array_flip($result);
    }
}