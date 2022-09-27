<?php

namespace backend\models;

use common\models\Message;
use yii\data\ActiveDataProvider;

class AdminMessage extends Message
{
    /**
     * @return ActiveDataProvider
     */
    public function getMessagesList(): ActiveDataProvider
    {
        $query = Message::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC,
                    'id' => SORT_DESC,
                ]
            ],
        ]);

        return $dataProvider;
    }
}
