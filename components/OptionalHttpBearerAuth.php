<?php

namespace app\components;

use yii\filters\auth\HttpBearerAuth;
use Yii;

class OptionalHttpBearerAuth extends HttpBearerAuth
{
    
   public function authenticate($user, $request, $response)
    {
        $token = $request->getHeaders()->get('Authorization');
        $adminToken = Yii::$app->params['ADMIN_ACCESS_TOKEN'] ?? '';

        if ($token === 'Bearer ' . $adminToken) {
            $identity = new \app\models\User([
                'id'          => 1,
                'username'    => 'admin',
                'role'        => 'admin',
                'accessToken' => $adminToken,
            ]);
            $user->setIdentity($identity);
            Yii::info('Admin authenticated');
            return $identity;
        }

        return null;
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
