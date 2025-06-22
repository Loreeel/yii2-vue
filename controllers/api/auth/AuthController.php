<?php

namespace app\controllers\api\auth;

use Yii;
use yii\rest\Controller;
use yii\web\Response;
use yii\web\UnauthorizedHttpException;
use app\models\User;

class AuthController extends Controller
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        // Удаляем аутентификацию, чтобы разрешить логин
        unset($behaviors['authenticator']);
        return $behaviors;
    }

    public function actionLogin()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $request = Yii::$app->request;

        $username = $request->post('username');
        $password = $request->post('password');

        $user = User::findByUsername($username);

        if (!$user || !$user->validatePassword($password)) {
            throw new UnauthorizedHttpException('Invalid credentials.');
        }

        if (!$user->access_token) {
            $user->generateAccessToken();
            $user->save(false);
        }

        return [
            'access_token' => $user->access_token,
            'role' => $user->role,
        ];
    }
}
