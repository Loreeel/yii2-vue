<?php

namespace app\controllers\api;

use Yii;

use app\models\Review;
use yii\rest\ActiveController;
use yii\web\ForbiddenHttpException;
use yii\filters\auth\AuthMethod;

class ReviewController extends ActiveController
{
    public $modelClass = 'app\models\Review';

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['authenticator'] = new class extends AuthMethod {
            public function authenticate($user, $request, $response)
            {
                $token = $request->getHeaders()->get('Authorization');
                $adminToken = Yii::$app->params['ADMIN_ACCESS_TOKEN']; 

                if ($token === 'Bearer ' . $adminToken) {
                    return true;
                }
                return null;
            }

            public function challenge($response)
            {
                $response->getHeaders()->set('WWW-Authenticate', 'Bearer realm="admin access"');
            }
        };

        $behaviors['authenticator']->except = ['index', 'view', 'create'];

        return $behaviors;
}


}