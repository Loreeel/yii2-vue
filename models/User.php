<?php
namespace app\models;

use yii\web\IdentityInterface;

class User implements IdentityInterface
{
    public $id;
    public $username;
    public $accessToken;
    public $role;

    public function __construct($config = [])
    {
        foreach ($config as $key => $value) {
            $this->$key = $value;
        }
    }
    
    public static function findIdentity($id) { return null; }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null; // используется напрямую в OptionalHttpBearerAuth
    }

    public function getId() { return $this->id; }
    public function getAuthKey() { return null; }
    public function validateAuthKey($authKey) { return false; }
}
