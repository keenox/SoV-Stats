<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%tasks}}".
 *
 * @property integer $id
 * @property integer $scene_id
 * @property integer $min
 * @property integer $max
 * @property string $description
 */
class Tasks extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tasks}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['scene_id', 'min', 'max'], 'integer'],
            [['description'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'scene_id' => 'Scene ID',
            'min' => 'Min',
            'max' => 'Max',
            'description' => 'Description',
        ];
    }

    /**
     * @inheritdoc
     * @return TasksQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TasksQuery(get_called_class());
    }
}
