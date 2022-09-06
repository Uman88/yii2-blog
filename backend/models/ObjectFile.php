<?php

namespace backend\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "object_file".
 *
 * @property int $id
 * @property int $item_id
 * @property string $title
 */
class ObjectFile extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'object_file';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['item_id'], 'integer'],
            [['title'], 'string', 'max' => 255],
        ];
    }
}
