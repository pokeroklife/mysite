<?php
declare(strict_types=1);

namespace app\components\behaviors;


use app\modules\blog\models\NewsCreateForm;
use app\modules\blog\models\NewsTag;
use app\modules\blog\models\Tag;
use app\modules\blog\models\TagsCreateForm;
use yii\base\Behavior;
use yii\db\ActiveRecord;
use yii\db\Exception;

class TagsCreateBehavior extends Behavior
{


    public function events(): array
    {
        return [
            ActiveRecord::EVENT_AFTER_INSERT => 'tagCreate',
            ActiveRecord::EVENT_AFTER_UPDATE => 'tagUpdate',
        ];
    }

    public function tagCreate(): void
    {
        $model = new NewsCreateForm();
        if ($model->load(\Yii::$app->request->post())) {
            $tags = Tag::getTags($model->tags);
            $newTags = $this->getNewTags($tags, $model->tags);
            foreach ($newTags as $name) {
                if (($tag = Tag::createTag($name)) === null) {
                    throw new Exception('error');
                }
                $tags[] = $tag;
            }
        } else {
            throw new Exception('тэги не сохранились');
        }

        NewsTag::createRelationArticleTags($tags, $this->owner->id);
    }

    public function tagUpdate(): void
    {

        $model = new TagsCreateForm();
        if ($model->load(\Yii::$app->request->post())) {
            $oldTags = Tag::getTags($model->name);
            $newTags = $this->getNewTags($oldTags, $model->name);

            foreach ($newTags as $name) {
                if (($tag = Tag::createTag($name)) === null) {
                    throw new Exception('error');
                }
                $oldTags[] = $tag;
            }
        } else {
            throw new Exception('тэги не сохранились');
        }

        if (NewsTag::deleteArticleTags($this->owner->id)) {
            NewsTag::createRelationArticleTags($oldTags, $this->owner->id);
        }
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