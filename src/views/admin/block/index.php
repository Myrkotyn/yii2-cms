<?php

use nullref\cms\models\Block;
use nullref\cms\models\Page;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('cms', 'Blocks');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="block-index">

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                <?= Html::encode($this->title) ?>
            </h1>
        </div>
    </div>


    <p>
        <?= Html::a(Yii::t('cms', 'Create Block'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                //'filter'=>\nullref\cms\components\Block::getManager()->getDropDownArray(),
                'attribute' => 'class_name',
                'value' => 'typeName'
            ],
            'createdAt:datetime',
            'updatedAt:datetime',
            [
              'attribute'=>'pages',
                'format'=>'html',
                'value'=>function(Block $model){
                    $names = \yii\helpers\ArrayHelper::getColumn($model->pages,function(Page $page){
                        return Html::a($page->title,['/cms/admin/page/update','id'=>$page->id],['class'=>'label label-primary']);
                    });
                    return implode(' ', $names);
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {config} {delete}',
                'buttons' => [
                    'config' => function ($url, Block $model, $key) {
                        $options = [
                            'title' => Yii::t('cms', 'Config'),
                            'aria-label' => Yii::t('cms', 'Config'),
                            'data-pjax' => '0',
                        ];
                        return Html::a('<span class="glyphicon glyphicon-cog"></span>', $url, $options);
                    }
                ]
            ],
        ],
    ]); ?>

</div>
