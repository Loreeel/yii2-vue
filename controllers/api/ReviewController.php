<?php

namespace app\controllers\api;

use Yii;
use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;
use app\models\Review;
use yii\web\ForbiddenHttpException;
use yii\filters\AccessControl;
use app\components\OptionalHttpBearerAuth;

class ReviewController extends ActiveController
{
    public $modelClass = 'app\models\Review';

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['authenticator'] = [
            'class' => OptionalHttpBearerAuth::class,
            'only' => ['index', 'view', 'update', 'delete'],
        ];

        $behaviors['access'] = [
            'class' => AccessControl::class,
            'only'  => ['update','delete'],
            'rules' => [
                [
                    'allow'         => true,
                    'roles'         => ['@'],
                    'matchCallback' => fn() => Yii::$app->user->identity->role==='admin',
                ],
            ],
            'denyCallback' => fn() => throw new ForbiddenHttpException('Access denied'),
        ];

        return $behaviors;
    }

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index']);
        return $actions;
    }

    public function actionIndex()
    {
        return new ActiveDataProvider([
            'query' => Review::findByUserRole(),
        ]);
    }
}
