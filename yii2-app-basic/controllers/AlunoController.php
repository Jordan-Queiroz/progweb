<?php

namespace app\controllers;

use Yii;
use app\models\Aluno;
use app\models\AlunoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;
use app\models\Curso;
use yii\data\ActiveDataProvider;

/**
 * AlunoController implements the CRUD actions for Aluno model.
 */
class AlunoController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Aluno models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AlunoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Aluno model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id=0)
    {   

        if ($id==0){  
            $queryAluno = Aluno::findOne(['matricula'=>21201414]);
            $queryCount = Aluno::find()->where('ano_ingresso='.$queryAluno->ano_ingresso)->count();
            return $this->render('view', [
                'model' =>  Aluno::findOne(['matricula'=>21201414]), 'queryCount'=>$queryCount, 'year'=>$queryAluno->ano_ingresso
            ]);
        } else {
            $queryAluno = Aluno::findOne(['id'=>$id]);
            $queryCount = Aluno::find()->where('ano_ingresso='.$queryAluno->ano_ingresso)->count();
            return $this->render('view', [
                'model' => $this->findModel($id),
                'queryCount'=>$queryCount, 'year'=>$queryAluno->ano_ingresso
            ]);
        }
    }

    /**
     * Creates a new Aluno model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Aluno();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionTurma($year){

        $searchModel = new AlunoSearch();

        $queryTurma = new ActiveDataProvider([
            'query' => Aluno::find()->
                              where(['ano_ingresso' => $year]),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('turma', [
            'dataProvider' => $queryTurma, 'searchModel' => $searchModel
        ]);
    }

    /**
     * Updates an existing Aluno model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Aluno model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    

    /**
     * Finds the Aluno model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Aluno the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Aluno::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
}
