<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use app\models\User;


/**
 * Site controller
 */
class HomeController extends Controller
{
    public $enableCsrfValidation = false;
    public function actionIndex(){
       return $this->render('home');
    }
    public function actionIndividual(){
        $time = $this->CookieGet('logTime','null');
        $id = $this->Get('id');
        $db =new User();
        $data = $db->find()->where(['id'=>$id])->all();
        return $this->render('individual',['time'=>$time,'data'=>$data]);
    }
    public function actionUpLogin(){
        $id =  $this->Get('id');
        $db =new User();
        $data = $db->find()->where(['id'=>$id])->all();
        return $this->render('uplogin',['data'=>$data]);
    }
    public function actionUpdate(){
        $username = $this->Post('username');
        $password = $this->Post('password');
        $id = $this->Post('id');
        $rand =rand(1000,9999);
        $pwd = md5($password.$rand);

        $one = new User();
        $one = $one->find()->where("id=$id")->one();
        $one->username = $username;
        $one->password = $pwd;
        $one->rand = $rand;
        $db = $one->save();
        if($db){
            echo 1;
           // return $this->redirect('?r=login/log-out');
        }else{
            echo 3;
        }

    }
}
