<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Trials]].
 *
 * @see Trials
 */
class TrialsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Trials[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Trials|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
