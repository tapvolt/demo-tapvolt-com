<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'created_at',
            'created_by',
            'lock_version',
            'updated_at',
            // 'updated_by',
            // 'enabled',
            // 'name',
            // 'email:email',
            // 'password_hash',
            // 'auth_key',
            // 'last_seen',
            // 'last_ip',
            // 'unconfirmed_email:email',
            // 'confirmed_at',
            // 'roles',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
