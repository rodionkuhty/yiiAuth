<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\CookieCollection;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\AuthForm;
use app\models\Users;
use yii\web\Session;
use yii\web\Cookie;
//use yii\web\Response as Res;
//use yii\web\CookieCollection;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

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
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionSignin()
    {

        $form = new AuthForm();
        if($form->load(Yii::$app->request->post()) && $form->validate()){
            $form->attributes = Yii::$app->request->post('AuthForm');
            $login = Users::find()->where(['login'=> $form->login] )->one();
            $password = Users::find()->where(['password' => Yii::$app->getSecurity()->generatePasswordHash($form->password)]);
            if($login && $password){
//                $session = Yii::$app->session;
//                $session->open();
//                Yii::$app->session->set('blabla','1234');
//                $cookies = Yii::$app->request->cookies;
//                $cookie = new Cookie([
//                    'name' => 'cookie_monster',
//                    'value' => 'Me want cookie!',
//                    'expire' => time() + 86400 * 365,
//                ]);
//                \Yii::$app->getResponse()->getCookies()->add($cookie);
                $session = Yii::$app->session;
                if ($session->isActive) {
                    $session->open();
                    
                    $session->set('user_id', '1234');
                    $user_id = $session->get('user_id');

                }



            }else{

               return $this->refresh();
            }
        }

        return $this->render('signin', compact('form','user_id'));
    }
}
