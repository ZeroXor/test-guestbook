<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \backend\models\MessageUpdateForm $model */

use common\models\User;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Редактировать отзыв';
?>
<div class="site-message-update">
    <div class="mt-5 offset-lg-3 col-lg-6">
        <h1><?= Html::encode($this->title) ?></h1>

        <?php $form = ActiveForm::begin(['id' => 'message-update-form']); ?>

        <?php
            if (User::isRoleAdministrator(Yii::$app->user->identity->id)) {
                $disabled = ['disabled' => false];
            } else {
                $disabled = ['disabled' => true];
            }
            $disabled = (User::isRoleAdministrator(Yii::$app->user->identity->id)) ? false : true;
        ?>
        <?= $form->field($model, 'username')->textInput(['disabled' => $disabled]) ?>
        <?= $form->field($model, 'text')->textarea(['disabled' => $disabled]) ?>

        <div class="form-check form-switch">
            <?= $form->field($model, 'has_approved')->checkbox() ?>
        </div>

        <div class="form-group">
            <?= Html::submitButton('Обновить отзыв', ['class' => 'btn btn-primary btn-block', 'name' => 'message-update-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
