<?php

namespace app\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;

class FruitController extends ActiveController
{
    public $modelClass = 'app\models\Fruit';

    public function afterAction($action, $result)
    {
        if ($action->id == 'create') {
            $message = Yii::$app->mailer->compose();

            try {
                $message->setFrom(getenv('MAIL_USERNAME'))
                    ->setTo(getenv('ADMIN_EMAIL'))
                    ->setSubject('Subject of the email')
                    ->setTextBody('Text content of the email')
                    ->setHtmlBody('<b>HTML content of the email</b>')
                    ->send();
            }
            catch (\Exception $e){
                Yii::error($e->getMessage());
            }

        }

        return parent::afterAction($action, $result);
    }


    public function actions(): array
    {
        $name = Yii::$app->request->get('name');
        $family = Yii::$app->request->get('family');
        $ids = Yii::$app->request->get('ids');

        $query = $this->modelClass::find();

        if($name){
            $query = $query->where([ 'like', 'name', $name]);
        }
        if($family){
            $query = $query->where(['like', 'family', $family]);
        }
        if($ids){
            $query = $query->where(['in', 'id', json_decode($ids, true)])
                ->select('*, (carbohydrates+protein+fat+sugar+calories) as nutrition_sum');
        }

        $actions = parent::actions();
        $actions['index'] = [
            'class' => 'yii\rest\IndexAction',
            'modelClass' => $this->modelClass,
            'prepareDataProvider' => fn() => new ActiveDataProvider(
                [
                    'query' => $query,
                    'pagination' => false,
                ]
            ),
        ];

        return $actions;
    }
}
