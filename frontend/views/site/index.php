<?php

/** @var yii\web\View $this */
/** @var \yii\data\ActiveDataProvider $dataProvider */

use yii\widgets\ListView;
use yii\bootstrap5\Html;

$this->title = 'Список отзывов';
?>

<div class="site-index">
    <div>
        <h1><?= Html::encode($this->title) ?></h1>

        <div class="list-group list-group-flush">
            <?=
            ListView::widget([
                'dataProvider' => $dataProvider,
                'options' => [
                    'tag' => 'div',
                    'class' => 'list-wrapper',
                    'id' => 'list-wrapper',
                ],
                'layout' => "{pager}\n{items}\n{pager}",
                'itemView' => '_list-item',
                'pager' => [
                    'maxButtonCount' => 8,
//                    'options' => [
//                        'tag' => 'ul',
//                        'class' => 'pagination',
//                    ],
                    'linkOptions' => ['class' => 'page-link'],
//                    'activePageCssClass' => 'page-item',
                    'disabledPageCssClass' => 'no-display',
                ],
                'emptyText' => 'Нет отзывов',
            ]);
            ?>
        </div>
    </div>

</div>
