<?php

namespace app\commands;

use app\models\Fruit;
use yii\httpclient\Client;

class FruitController extends \yii\console\Controller
{
    public function actionIndex(){
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('GET')
            ->setUrl('https://fruityvice.com/api/fruit/all')
            ->send();
        if ($response->isOk) {
            $fruits = $response->data;
            foreach ($fruits as $fruit){

                // insert fruit data
                $fruitModel = new Fruit();

                $fruitModel->genus = $fruit['genus'];
                $fruitModel->family = $fruit['family'];
                $fruitModel->name = $fruit['name'];
                $fruitModel->order = $fruit['order'];
                $fruitModel->calories = $fruit['nutritions']['calories'];
                $fruitModel->fat = $fruit['nutritions']['fat'];
                $fruitModel->carbohydrates = $fruit['nutritions']['carbohydrates'];
                $fruitModel->protein = $fruit['nutritions']['protein'];
                $fruitModel->sugar = $fruit['nutritions']['protein'];

                $fruitModel->insert();
            }
        }
    }

}
