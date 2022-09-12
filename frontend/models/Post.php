<?php

namespace frontend\models;

use backend\models\ObjectFile;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "post".
 */
class Post extends ActiveRecord
{
    /**
     * Get post by id
     *
     * @param $id
     * @return array|ActiveRecord|null
     */
    public static function getOnePost($id)
    {
        return self::find()->where(['id' => $id])->one();
    }

    /**
     * Get title image
     *
     * @param $id
     * @return mixed|void|null
     */
    public static function getTitleImage($id)
    {
        if ($id) {
            return ObjectFile::find()->where(['id' => $id])->one()->title;
        }
    }

    /**
     * Truncation string for title to main page
     *
     * @param $string
     * @return string
     */
    public static function truncationString($string)
    {
        $string = strip_tags($string);
        $string = substr($string, 0, 70);
        $string = rtrim($string, '!,.-');
        $string = substr($string, 0, strrpos($string, ' '));
        $string = $string . '...';

        return $string;
    }

    /**
     * Get all post by id category and also status
     *
     * @param $id
     * @return array|ActiveRecord|null
     */
    public static function getAllPostByIdCategory($id)
    {
        return self::find()
            ->where(['status' => \backend\models\Post::STATUS_ACTIVE])
            ->andWhere(['category_id' => $id])
            ->all();
    }

    /**
     * Get title category by id, first element
     *
     * @param $id
     * @return array|ActiveRecord|null
     */
    public static function getTitleCategory($id)
    {
        return self::find()->where(['id' => $id])->one();
    }

    /**
     * Get post id, find post by id and set to 1 view
     *
     * @param $id
     * @return Post|null
     */
    public static function setViewed($id)
    {
        $view = self::findOne(['id' => $id]);
        $view->viewed += 1;
        $view->save();
        return $view;
    }

    /**
     * Get post id and find post with viewed post
     *
     * @param $id
     * @return array|ActiveRecord|null
     */
    public static function getViewed($id)
    {
        return self::find()->where(['id' => $id])->one();
    }
}