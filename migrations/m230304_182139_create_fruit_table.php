<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%fruit}}`.
 */
class m230304_182139_create_fruit_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('fruit', [
            'id' => $this->primaryKey(),
            'genus' => $this->string(),
            'name' => $this->string(),
            'family' => $this->string(),
            'order' => $this->string(),
            'carbohydrates' => $this->double()->null(),
            'protein' => $this->double()->null(),
            'fat' => $this->double()->null(),
            'calories' => $this->double()->null(),
            'sugar' => $this->double()->null(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('fruit');
    }
}
