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
    public function actionView($id)
    {
       /* $queryAluno = new Query;
        $queryAluno->select('ano_ingresso')
                   ->from('aluno')
                   ->where('id='.$id)
                   ->all();
        //$number = queryAluno->all();
       /* $queryCount = new Query;
        $queryCount->count();
              ->from('aluno')
              ->where('ano_ingresso = {$year}'); */
        $queryAluno = Aluno::findOne(['id'=>$id]);
        $queryCount = Aluno::find()->where('ano_ingresso='.$queryAluno->ano_ingresso)->count();

        if (isset($id)){  
            return $this->render('view', [
                'model' => $this->findModel($id), 'queryCount'=>$queryCount, 'year'=>$queryAluno->ano_ingresso
            ]);
        } else {
            return $this->render('view', [
                'model' => $this->findModel(21201414), //1305
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
        //$courses = Curso::find()->where(['id'=>'1'])->select('nome');//findOne(1)->select("nome"); //findAll('[1,2,3]');//find()->where(["id=1 || id=2 || id=3"])->select("nome");

        $query = new Query;
        $query->select('nome')
              ->from('curso');
        $courses = $query->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model, 'courses' => $courses
            ]);
        }
    }

    public function actionTurma($year){

        $searchModel = new AlunoSearch();
        //$queryTurma = $searchModel->search('ano_ingresso = '.$year);
        //Aluno::find()->where('ano_ingresso = '.$year)->all();

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

        $query = new Query;
        $query->select('nome')
              ->from('curso');
        $courses = $query->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model, 'courses' => $courses
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
    /*# Legal, mas como usar isso?
    public function beforeAction($action)
    {
        if (!parent::beforeAction($action)) {
            return false;
        }

        return true; // or false to not run the action
    }*/
    /*protected function findModel()
    {
        if (($model = Aluno::findOne('21201414')) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }*/
}
