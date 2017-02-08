<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%trials}}".
 *
 * @property integer $id
 * @property integer $scene_id
 * @property integer $test_id
 * @property string $start_time
 * @property string $end_time
 */
class Trials extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%trials}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['scene_id', 'test_id'], 'required'],
            [['scene_id', 'test_id'], 'integer'],
            [['start_time', 'end_time'], 'safe'],
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
            'test_id' => 'Test ID',
            'start_time' => 'Start Time',
            'end_time' => 'End Time',
        ];
    }

    /**
     * @inheritdoc
     * @return TrialsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TrialsQuery(get_called_class());
    }
}
