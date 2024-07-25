<?php

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Projects';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-projects">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        This is the Projects page.
    </p>

    <!-- Add Project Button -->
    <p>
        <?= Html::a('Add Project', ['add'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'title',
            'description',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
            ],
        ],
    ]); ?>

</div>