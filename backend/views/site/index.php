<?php

/** @var yii\web\View $this */
/** @var \yii\data\ActiveDataProvider $dataProvider */
/** @var \backend\models\AdminMessageSearch $searchModel */

use yii\grid\GridView;
use yii\bootstrap5\Html;
use kartik\date\DatePicker;
use common\models\User;

$this->title = 'Гостевая книга - Панель управления';
?>
<div class="site-index">
    <div class="body-content">

        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'pager' => [
                'maxButtonCount' => 8,
                'linkOptions' => ['class' => 'page-link'],
                'disabledPageCssClass' => 'no-display',
            ],
            'columns' => [
                [
                    'attribute' => 'username',
                    'label' => 'Автор',
                ],
                [
                    'attribute' => 'text',
                ],
                [
                    'attribute' => 'created_at',
                    'format' => ['date', 'php:Y-m-d h:i:s'],
                    'filter' => DatePicker::widget([
                        'model' => $searchModel,
                        'attribute' => 'created_at_begin',
                        'attribute2' => 'created_at_end',
                        'separator' => '-',
                        'type' => DatePicker::TYPE_RANGE,
                        'pluginOptions' => [
                            'format' => 'yyyy-mm-dd',
                            'todayHighlight' => true,
                        ],
                        'options' => ['autocomplete' => 'off'],
                        'options2' => ['autocomplete' => 'off'],
                        'language' => 'ru',
                    ]),
                ],
                [
                    'attribute' => 'updated_at',
                    'format' => ['date', 'php:Y-m-d']
                ],
                [
                    'attribute' => 'has_approved',
                    'filter' => ['0' => 'Не опубликовано', '1' => 'Опубликовано'],
                    'format' => 'raw',
                    'value' => function ($model, $key, $index, $column) {
                        /** @var \yii\grid\DataColumn $column */
                        $value = $model->{$column->attribute};
                        if (empty($value)) {
                            $class = 'danger';
                            $content = 'Не опубликовано';
                        } else {
                            $class = 'success';
                            $content = 'Опубликовано';
                        }
                        $html = Html::tag('span', Html::encode($content), ['class' => 'badge bg-' . $class]);
                        return $value === null ? $column->grid->emptyCell : $html;
                    }
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{update} {delete}',
                    'visibleButtons' => [
                        'update' => true,
                        'delete' => User::isRoleAdministrator(Yii::$app->user->identity->id),
                    ],
                ],
            ],
        ]);
        ?>

    </div>
</div>
