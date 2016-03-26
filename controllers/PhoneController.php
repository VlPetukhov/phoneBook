<?php
/**
 * @class PhoneController
 * @namespace app\controllers
 */

namespace app\controllers;

use app\models\PhoneNumber;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class PhoneController extends Controller
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
                        'actions' => ['index', 'view','create', 'update', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
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
        $searchModel = new PhoneNumber(['scenario' => 'search']);

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
        $model = new PhoneNumber(['scenario' => 'create']);

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
        /** @var PhoneNumber $model */
        $model = PhoneNumber::findOne($id);

        if ( !$model ) {

            Yii::$app->getSession()->setFlash('alerts', 'PhoneNumber was not found!');
            $this->redirect(['index']);
        }

        $model->scenario = 'update';

        if ( $model->load(Yii::$app->request->post()) && $model->save() ) {

            Yii::$app->getSession()->setFlash('alerts', 'PhoneNumber was successfully created!');
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
        /** @var PhoneNumber $model */
        $model = PhoneNumber::findOne( $id );

        if ( $model && $model->delete()) {

            Yii::$app->getSession()->setFlash('alerts', 'PhoneNumber successfully deleted.');
        } else {

            Yii::$app->getSession()->setFlash('alerts', 'PhoneNumber was not deleted!');
        }

            return $this->redirect(['index']);
    }

    public function actionView( $id = null )
    {
        /** @var PhoneNumber $model */
        $model = PhoneNumber::findOne($id);

        if ( !$model ) {

            Yii::$app->getSession()->setFlash('alerts', 'PhoneNumber was not found!');
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