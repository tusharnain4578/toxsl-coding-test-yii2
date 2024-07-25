<?php

/** @var yii\web\View $this */
/** @var app\models\forms\ProjectForm $model */

use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;

$this->title = 'Add New Project';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-projects">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        Add new project by filling up the below form.
    </p>

    <!-- Add Project Button -->
    <p>
        <?= Html::a('All Projects', ['index'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="card">
        <div class="card-body">
            <?php $form = ActiveForm::begin([
                'id' => 'login-form',
                'fieldConfig' => [
                    'template' => "{label}\n{input}\n{error}",
                    'labelOptions' => ['class' => 'col-lg-1 col-form-label mr-lg-3'],
                    'inputOptions' => ['class' => 'col-lg-3 form-control'],
                    'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
                ],
            ]); ?>

            <?= $form->field($model, 'title')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'description')->textarea() ?>


            <div class="form-group text-end">
                <?= Html::submitButton(ucfirst($mode) . ' Project', ['class' => 'btn btn-primary', 'name' => 'add-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>

</div>