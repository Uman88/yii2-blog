<?php

namespace frontend\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "Category".
 */
class Category extends ActiveRecord
{
    /**
     * Get Category
     *
     * @return array|ActiveRecord[]
     */
    public static function getCategory()
    {
        return self::find()->all();
    }

    /**
     * Get title category by id for breadcrumbs
     *
     * @param $id
     * @return array|ActiveRecord|null
     */
    public static function getTitleCategoryByIdForBreadCrumbs($id)
    {
        return self::find()->where(['id' => $id])->one();
    }
}