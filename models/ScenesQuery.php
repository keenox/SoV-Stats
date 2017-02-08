<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Scenes]].
 *
 * @see Scenes
 */
class ScenesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Scenes[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Scenes|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
