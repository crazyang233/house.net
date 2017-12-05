<?php
namespace backend\controllers;

use app\models\User;
use Yii;
use yii\web\Controller;
use yii\web\cookie;


/**
 * Site controller
 */
class LoginController extends Controller
{
    public $enableCsrfValidation = false;
    public $layout = false;
    public function actionIndex(){
        if($this->isPost()){
            $username = $this->Post('username');
            $password = $this->Post('password');
            $db = new User();
            $uname = $db->find()->where(['username'=>$username])->one();
         if($uname){
                $rpwd = md5($password.$uname['rand']);
                $pwd = $db->find()->where(['password'=>$rpwd])->one();
                $id = $uname['id'];
                $times = date("Y-m-d H:i:s",time());

                $usern = $uname['username'];
                $this->CookieAdd('id',$id);
                $this->CookieAdd('name',$usern);
                $this->CookieAdd('logTime',$times);
                return ($pwd)? "3":"2";
            }else{
                return 1;
            }
        }else{
            return $this->render('login');
        }
    }

    public function actionLogOut(){
           \yii::$app->response->cookies->remove('name');
           \yii::$app->response->cookies->remove('id');
       return $this->goLogin();
    }

}
