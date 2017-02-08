<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%tests}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $start_time
 * @property string $end_time
 */
class Tests extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tests}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
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
            'user_id' => 'User ID',
            'start_time' => 'Start Time',
            'end_time' => 'End Time',
        ];
    }

    /**
     * @inheritdoc
     * @return TestsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TestsQuery(get_called_class());
    }
}
