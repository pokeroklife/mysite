<?php
declare(strict_types=1);

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\AuthAssignment;
use app\modules\admin\AuthAssignmentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * Class AdminController
 * @package app\modules\admin\controllers
 */
class AdminController extends Controller
{
    /**
     * @return array
     */
    public function behaviors(): array
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * @return string
     */
    public function actionIndex(): string
    {
        $searchModel = new AuthAssignmentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param $item_name
     * @param $user_id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($item_name, $user_id): string
    {
        return $this->render('view', [
            'model' => $this->findModel($item_name, $user_id),
        ]);
    }

    /**
     * @return string|Response
     */
    public function actionCreate()
    {
        $model = new AuthAssignment();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'item_name' => $model->item_name, 'user_id' => $model->user_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * @param $item_name
     * @param $user_id
     * @return string|Response
     * @throws NotFoundHttpException
     */
    public function actionUpdate($item_name, $user_id)
    {
        $model = $this->findModel($item_name, $user_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'item_name' => $model->item_name, 'user_id' => $model->user_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * @param $item_name
     * @param $user_id
     * @return Response
     * @throws NotFoundHttpException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($item_name, $user_id): Response
    {
        $this->findModel($item_name, $user_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * @param $item_name
     * @param $user_id
     * @return AuthAssignment
     * @throws NotFoundHttpException
     */
    protected function findModel($item_name, $user_id): AuthAssignment
    {
        if (($model = AuthAssignment::findOne(['item_name' => $item_name, 'user_id' => $user_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
