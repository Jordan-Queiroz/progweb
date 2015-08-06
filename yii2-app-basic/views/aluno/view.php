<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Aluno */
/* @var $queryCount app\controllers\Aluno*/
/* @var $year app\controllers\Aluno*/

$this->title = $model->nome;
$this->params['breadcrumbs'][] = ['label' => 'Alunos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aluno-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'matricula',
            'nome',
            'sexo',
            'id_curso',
            'ano_ingresso',
        ],
    ]) ?>

    <p>Em nossa base, existem <?= $queryCount ?> alunos de <?= $year ?></p>
    <?= Html::a('Alunos do mesmo ano', ['turma', 'year' => $year], ['class' => 'btn btn-primary']) ?>

</div>
