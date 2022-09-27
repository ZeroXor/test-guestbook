<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\AddMessageForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Добавить отзыв';
?>
<div class="site-add-form">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-6">
            <?php $form = ActiveForm::begin(['id' => 'add-message-form']); ?>
                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
                <?= $form->field($model, 'message')->textarea(['rows' => 6]) ?>
                <div class="form-group">
                    <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary', 'name' => 'add-message-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>

<?php
$js = <<<JS
    $('#add-message-form').on('beforeSubmit', function () {
       var data = $(this).serialize();
        $.ajax({
            url: '/site/add-message',
            type: 'POST',
            data: data,
            success: function (res) {
                $('#add-message-form').find('input').val('');
                $('#add-message-form').find('textarea').val('');
                alert(res.message);
            },
            error: function () {
                alert('Ошибка!');
            }
        });
        return false;
    });
JS;

$this->registerJs($js);
