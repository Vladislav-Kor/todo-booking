<?php

namespace app\controllers;

use Yii;
use yii\web\Response;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        // $personalList = include Yii::getAlias('@app/data/personalList.php');
        // $employeeSchedules = include Yii::getAlias('@app/data/employeeSchedules.php');
        $serviceList = include Yii::getAlias('@app/data/serviceList.php');
        // $serviceSchedules = include Yii::getAlias('@app/data/serviceSchedules.php');
        // $plannedSchedule = include Yii::getAlias('@app/data/plannedSchedule.php');

        // $this->layout('/service');
        return $this->render('../service/index',['serviceList'=> $serviceList]);
    }

    public function actionSchedule()
    {
        $list = [];
        if (\Yii::$app->request->isPost) {
            $actions = Yii::$app->request->post('actions', []);
            $items = Yii::$app->request->post('items', []);
            $personalList = include Yii::getAlias('@app/data/personalList.php');
            $employeeSchedules = include Yii::getAlias('@app/data/employeeSchedules.php');
            $serviceList = include Yii::getAlias('@app/data/serviceList.php');
            $serviceSchedules = include Yii::getAlias('@app/data/serviceSchedules.php');
            $plannedSchedule = include Yii::getAlias('@app/data/plannedSchedule.php');
            var_dump($actions);
            switch ($actions) {
                case 'service':
                    $list = $serviceList;
                    break;
                case 'personal':
                    $list = $personalList;
                    break;
                case 'date':
                    $list = $serviceList;
                    break;
                default:
                    $list = $serviceList;
                    break;
            }
            var_dump($items);
        }
        return $this->render('../service/index',['list'=> $list]);
    }
}
