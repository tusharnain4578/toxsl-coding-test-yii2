<?php

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-users">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        This is the Users page.
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            'email',
            [
                'attribute' => 'role',
                'value' => function ($model) {
                        return ucfirst($model->role);
                    },
            ],
        ],
    ]); ?>


</div>