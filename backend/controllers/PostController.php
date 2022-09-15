<?php

namespace backend\controllers;

use Yii;
use backend\models\ObjectFile;
use backend\models\Post;
use yii\data\ActiveDataProvider;
use yii\helpers\VarDumper;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

/**
 * PostController implements the CRUD actions for Post model.
 */
class PostController extends BehaviorsController
{
    /**
     * Lists all Post models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Post::find(),
            'pagination' => [
                'pageSize' => 10
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Post model.
     *
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return string|yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Post();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                if ($model->validate()) {
                    if ($model->image = UploadedFile::getInstance($model, 'image')) {
                        $objectFile = new ObjectFile();
                        $objectFile->title = md5(microtime()) . '.' . $model->image->extension;
                        $objectFile->item_id = $model->id;
                        if ($objectFile->save(false)) {
                            $model->image->saveAs('uploads' . DIRECTORY_SEPARATOR . $objectFile->title);
                            $model->img_id = $objectFile->id;
                            $model->save(false);
                        }
                    }
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Post model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                if ($model->validate()) {
                    if ($model->image = UploadedFile::getInstance($model, 'image')) {
                        $objectFile = new ObjectFile();
                        $objectFile->title = md5(microtime()) . '.' . $model->image->extension;
                        $objectFile->item_id = $model->id;
                        if ($objectFile->save(false)) {
                            $model->image->saveAs('uploads' . DIRECTORY_SEPARATOR . $objectFile->title);
                            $model->img_id = $objectFile->id;
                            $model->save(false);
                        }
                    }
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Post model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        $model = Post::findOne(['id' => $id]);
        $objectFile = ObjectFile::find()->where(['id' => $model->img_id])->one();

        if ($objectFile) {
            unlink(Yii::getAlias('@webroot') . '/uploads/' . $model->getTitleImage($id));
            $objectFile->delete();
        }
        $this->findModel($id)->delete();

        Yii::$app->session->setFlash('success', 'Новость удалена!');

        return $this->redirect(['index']);
    }

    /**
     * Deletes an existing image.
     * If delete is successful, the browser will stay on the existing page.
     *
     * @param $id
     * @return \yii\web\Response
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDeleteImage($id)
    {
        if ($id) {
            $model = Post::findOne(['img_id' => $id]);
            $objectFile = ObjectFile::find()->where(['id' => $model->img_id])->one();

            if ($objectFile) {
                unlink(Yii::getAlias('@webroot') . '/uploads/' . $model->getTitleImage($id));
                $objectFile->delete();
                $model->img_id = null;
                $model->save();

                Yii::$app->session->setFlash('success', 'Изображение удалено!');
            } else {
                Yii::$app->session->setFlash('error', 'Изображение удалено!');
            }
        }

        return $this->redirect(['update', 'id' => $model->id]);
    }

    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param int $id ID
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Post::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
