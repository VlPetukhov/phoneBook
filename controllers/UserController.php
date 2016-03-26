<?php
/**
 * @class UserController
 * @namespace app\controllers
 */

namespace app\controllers;

use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

class UserController extends Controller
{

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'view','logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['create', 'update', 'delete'],
                        'allow' => true,
                        'matchCallback' => function(){ return 1 == Yii::$app->user->getId(); }, //only admin (ID=1) can make CRUD operations
                    ],
                ],
            ],
            'verbs' => [
                'class'   => VerbFilter::className(),
                'actions' => [
                    'logout'     => ['post'],
                    'createUser' => ['post'],
                    'updateUser' => ['post'],
                    'deleteUser' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @return array
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new User(['scenario' => 'search']);

        return $this->render(
            'index',
            [
                'dataProvider' => $searchModel->search(Yii::$app->request->get()),
                'searchModel' => $searchModel,
            ]
        );
    }

    /**
     * @return string
     */
    public function actionCreate()
    {
        $model = new User(['scenario' => 'create']);

        if ( $model->load(Yii::$app->request->post()) && $model->save() ) {

            $this->redirect(['index']);
        }

        return $this->render(
            'create',
            [
                'model' => $model,
            ]
        );
    }

    /**
     * @param integer|null $id
     *
     * @return string
     */
    public function actionUpdate( $id = null )
    {
        /** @var User $model */
        $model = User::findOne($id);

        if ( !$model ) {

            Yii::$app->getSession()->setFlash('alerts', 'User was not found!');
            $this->redirect(['index']);
        }

        $model->scenario = 'update';

        if ( $model->load(Yii::$app->request->post()) && $model->save() ) {

            Yii::$app->getSession()->setFlash('alerts', 'User was successfully created!');
            $this->redirect(['index']);
        }

        return $this->render(
            'create',
            [
                'model' => $model,
            ]
        );
    }

    /**
     * @param integer|null $id
     *
     * @return \yii\web\Response
     */
    public function actionDelete( $id = null )
    {
        /** @var User $model */
        $model = User::findOne( $id );

        if ( $model && $model->delete()) {

            Yii::$app->getSession()->setFlash('alerts', 'User successfully deleted.');
        } else {

            Yii::$app->getSession()->setFlash('alerts', 'User was not deleted!');
        }

            return $this->redirect(['index']);
    }

    public function actionView( $id = null )
    {
        /** @var User $model */
        $model = User::findOne($id);

        if ( !$model ) {

            Yii::$app->getSession()->setFlash('alerts', 'User was not found!');
            $this->redirect(['index']);
        }

        return $this->render(
            'view',
            [
                'model' => $model,
            ]
        );
    }
}