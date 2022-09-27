<?php
/**
 * @var $model
 */
?>

<div class="list-group-item message-list-item">
    <p class="message-list-item-date"><?= date('d.m.Y h:i', $model->created_at) ?></p>
    <p class="message-list-item-user"><?= $model->username ?></p>
    <p><?= $model->text ?></p>
</div>
