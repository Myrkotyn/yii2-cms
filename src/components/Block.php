<?php

namespace nullref\cms\components;


use yii\base\Model;
use yii\base\Widget;

abstract class Block extends Model
{
    public $formFile = '_form.php';

    public abstract function getName();

    protected function getDir() {
        $reflector = new \ReflectionClass(get_class($this));
        return dirname($reflector->getFileName());
    }

    public function getForm()
    {
        return realpath($this->getDir().'/'.$this->formFile);
    }

    public function getConfig()
    {
        return $this->getAttributes(null,['formFile']);
    }

    /**
     * @param string $moduleId
     * @return BlockManager
     */
    public static function getManager($moduleId='cms')
    {
        return \Yii::$app->getModule($moduleId)->get('blockManager');
    }
}