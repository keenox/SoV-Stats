<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%score}}".
 *
 * @property integer $id
 * @property integer $task_id
 * @property integer $trial_id
 * @property integer $value
 */
class Score extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%score}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['task_id', 'trial_id'], 'required'],
            [['task_id', 'trial_id', 'value'], 'integer'],
            [['trial_id', 'task_id'], 'unique', 'targetAttribute' => ['trial_id', 'task_id'], 'message' => 'The combination of Task ID and Trial ID has already been taken.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'task_id' => 'Task ID',
            'trial_id' => 'Trial ID',
            'value' => 'Value',
        ];
    }

    /**
     * @inheritdoc
     * @return ScoreQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ScoreQuery(get_called_class());
    }
}
