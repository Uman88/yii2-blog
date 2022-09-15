<?php

namespace backend\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "post".
 *
 * @property int $id
 * @property int $category_id
 * @property int $status
 * @property int $viewed
 * @property string $title
 * @property string $description
 * @property string $content
 * @property string $author
 * @property int $img_id
 * @property int $created_at
 * @property int $updated_at
 */
class Post extends ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    static $status = [
        self::STATUS_ACTIVE => 'Активный',
        self::STATUS_INACTIVE => 'Неактивный',
    ];

    /**
     * @var
     */
    public $image;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'status', 'title', 'description', 'content', 'author'], 'required'],
            [['category_id', 'status', 'viewed', 'img_id', 'created_at', 'updated_at'], 'integer'],
            [['author', 'content'], 'string'],
            [['description'], 'string', 'max' => 255],
            [['author'], 'string', 'max' => 150],
            [['image'], 'file', 'extensions' => 'png, jpg', 'maxFiles' => 1, 'maxSize' => 1024 * 1024 * 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'category_id' => Yii::t('app', 'Категория'),
            'status' => Yii::t('app', 'Статус'),
            'viewed' => Yii::t('app', 'Просмотры'),
            'title' => Yii::t('app', 'Заголовок'),
            'description' => Yii::t('app', 'Описание'),
            'content' => Yii::t('app', 'Контент'),
            'author' => Yii::t('app', 'Автор'),
            'image' => Yii::t('app', 'Изображение'),
            'created_at' => Yii::t('app', 'Создан'),
            'updated_at' => Yii::t('app', 'Обновлен'),
        ];
    }

    /**
     * @return array[]
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'created_at',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'updated_at',
                ],
            ],
        ];
    }

    /**
     * Get title image
     *
     * @param $id
     * @return mixed|void|null
     */
    public static function getTitleImage($id)
    {
        $objectFile = ObjectFile::find()->where(['item_id' => $id])->one();
        if (isset($objectFile->title)) {
            return $objectFile->title;
        }
    }

    /**
     * Relation one to many
     *
     * @return \yii\db\ActiveQuery
     * @return Category
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    /**
     * Get title from table category
     *
     * @return mixed
     */
    public function getTitleCategory()
    {
        return $this->category->title;
    }
}
