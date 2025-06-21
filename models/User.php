<?php
namespace app\models;

use yii\base\BaseObject;
use yii\web\IdentityInterface;

class User extends BaseObject implements IdentityInterface
{
    public static function findIdentity($id) { return null; }
    public static function findIdentityByAccessToken($token, $type = null) { return null; }
    public function getId() { return null; }
    public function getAuthKey() { return null; }
    public function validateAuthKey($authKey) { return false; }
}