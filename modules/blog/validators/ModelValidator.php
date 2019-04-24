<?php

declare(strict_types=1);
namespace app\modules\blog\validators;

use Yii;
use yii\base\InvalidConfigException;
use yii\base\Model;
use yii\validators\Validator;

/**
 * Class ModelValidator
 * @package app\modules\v1\components\validators
 *
 * @author pacodes <pacodes.info@gmail.com>
 */
class ModelValidator extends Validator
{
    /**
     * @var string
     */
    public $modelClass;

    /**
     * @var bool
     */
    public $skipOnEmpty = false;

    /**
     * @var string
     */
    public $scenario = Model::SCENARIO_DEFAULT;

    /**
     * Сообщение валидации при ошибке.
     *
     * @var string
     */
    public $message;

    /**
     * @throws InvalidConfigException
     */
    public function init(): void
    {
        parent::init();
        if ($this->modelClass === null) {
            throw new InvalidConfigException('The "modelClass" property must be set.');
        }
        if ($this->message === null) {
            $this->message = Yii::t('yii', '{attribute} is invalid.');
        }
    }

    /**
     * @param Model $model
     * @param string $attribute
     */
    public function validateAttribute($model, $attribute): void
    {
        $value = $model->$attribute;
        if (!is_array($value) && !$value instanceof \ArrayAccess) {
            $this->addError($model, $attribute, $this->message, []);
            return;
        }
        $modelClass = $this->modelClass;
        /* @var $item Model */
        $item = new $modelClass([
            'scenario' => $this->scenario
        ]);
        $item->setAttributes($value);

        if (!$item->validate()) {
            $this->addError($model, $attribute, $this->getFirstError($item), []);
        }
    }

    /**
     * @param Model $item
     *
     * @return string
     */
    protected function getFirstError(Model $item): string
    {
        $errors = $item->getFirstErrors();
        if ($errors === []) {
            return $this->message;
        }
        $error = reset($errors);

        return $error;
    }
}