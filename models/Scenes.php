<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%scenes}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 */
class Scenes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%scenes}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 45],
            [['description'], 'string', 'max' => 200],
            [['name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
        ];
    }

    /**
     * @inheritdoc
     * @return ScenesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ScenesQuery(get_called_class());
    }
}
