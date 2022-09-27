<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class AdminMessageSearch extends Model
{
    public ?string $text = '';
    public ?bool $has_approved = null;
    public ?int $created_at = null;
    public ?string $created_at_begin = '';
    public ?string $created_at_end = '';

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['created_at'], 'integer'],
            ['has_approved', 'boolean'],
            [['text', 'created_at_begin', 'created_at_end'], 'string'],
        ];
    }

    /**
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search(array $params): ActiveDataProvider
    {
        $query = AdminMessage::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC
                ]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        $query
            ->andFilterWhere(['like', 'text', $this->text])
            ->andFilterWhere(['like', 'has_approved', $this->has_approved]);

        if (!empty($this->created_at_begin)) {
            $query->andFilterWhere(['>=', 'created_at', strtotime($this->created_at_begin . '00:00:00')]);
        }
        if (!empty($this->created_at_end)) {
            $query->andFilterWhere(['<=', 'created_at', strtotime($this->created_at_end . '23:59:59')]);
        }

        return $dataProvider;
    }
}
