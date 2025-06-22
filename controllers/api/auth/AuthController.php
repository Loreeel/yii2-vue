<?php

namespace app\controllers\api\auth;

use Yii;
use yii\rest\Controller;
use yii\web\UnauthorizedHttpException;
use yii\web\Response;

class AuthController extends Controller
{
    public function actionLogin()
    {
        $authHeader = Yii::$app->request->getHeaders()->get('Authorization');

        if ($authHeader && preg_match('/^Bearer\s+(.*?)$/', $authHeader, $matches)) {
            $requestToken = $matches[1];
        } else {
            throw new UnauthorizedHttpException('Missing or invalid Authorization header.');
        }

        $adminAccessToken = Yii::$app->params['ADMIN_ACCESS_TOKEN'];
        $adminToken = Yii::$app->params['ADMIN_REFRESH_TOKEN'];

        if ($requestToken === $adminToken) {
            return [
                'access_token' => $adminAccessToken,
            ];
        }

        throw new UnauthorizedHttpException('Invalid token.');
    }
}
