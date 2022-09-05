<?php

namespace backend\controllers;

use Yii;
use Throwable;
use backend\models\Category;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

/**
 * Category Controller
 */
class CategoryController extends BehaviorsController
{
    /**
     * Lists all Category models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Category::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Category model.
     *
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Create new Category model.
     * If create is successful, the browser will be redirected to the 'index' page.
     *
     * @param $id
     * @return string|yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Category();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $model->save();
            }
            return $this->redirect(['index']);
        }

        return $this->render('create', ['model' => $model]);
    }

    /**
     * Updates an existing Category model.
     * If update is successful, the browser will be redirected to the 'index' page.
     *
     * @param $id
     * @return string|yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $model->save();
            }
            return $this->redirect(['index']);
        }

        return $this->render('update', ['model' => $model]);
    }

    /**
     * Finds id by category model based.
     * If found category, delete category and redirect 'index' page.
     *
     * @param $id
     * @return yii\web\Response
     * @throws NotFoundHttpException
     * @throws Throwable
     * @throws yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        $model = Category::findOne(['id' => $id]);

        if($model){
            $this->findModel($model['id'])->delete();
        }
        Yii::$app->session->setFlash('success', 'Категория удалена!');
        return $this->redirect(['index']);
    }

    /**
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
