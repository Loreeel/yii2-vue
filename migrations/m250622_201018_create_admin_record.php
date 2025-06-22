<?php

use yii\db\Migration;

class m250622_201018_create_admin_record extends Migration
{
   public function safeUp()
    {
        $this->insert('user', [
            'username' => 'admin',
            'password_hash' => Yii::$app->security->generatePasswordHash(Yii::$app->params['ADMIN_PASSWORD']),
            'auth_key' => Yii::$app->security->generateRandomString(),
            'role' => 'admin',
        ]);
    }

    public function safeDown()
    {
        $this->delete('user', ['username' => 'admin']);
    }
}
