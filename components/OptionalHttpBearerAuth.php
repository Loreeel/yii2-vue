<?php

namespace app\components;

use yii\filters\auth\HttpBearerAuth;
use Yii;

class OptionalHttpBearerAuth extends HttpBearerAuth
{
    public function authenticate($user, $request, $response)
    {
        $authHeader = $request->getHeaders()->get('Authorization');

        if (!$authHeader || !preg_match('/^Bearer\s+(.*?)$/', $authHeader, $matches)) {
            return null; 
        }

        $token = $matches[1];
        $identity = $user->loginByAccessToken($token, get_class($this));

        return $identity ?: null;
    }

    public function beforeAction($action): bool
    {
        $this->authenticate(Yii::$app->user, Yii::$app->request, Yii::$app->getResponse());

        return true;
    }

    public function handleFailure($response)
    {
        return null;
    }
}