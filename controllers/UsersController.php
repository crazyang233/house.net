<?php
namespace backend\controllers;

use Yii;
use app\models\Users;
use app\models\ValidateCode;
use yii\helpers\Url;
use yii\web\UploadedFile;
use yii\data\ActiveDataProvider;
use app\models\Pages;
use app\models\PictureHandle;

class UsersController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $p = Yii::$app->request->post('p') ? Yii::$app->request->post('p') : 1;
    	if(Yii::$app->request->post('flag') == 1)
        {
            $uid = Yii::$app->request->post('uid');
            $user = Users::findOne($uid);
            $user->status = '1';
            $r = $user->save();
            if($r)
            {
                echo 0;
            }else{
                echo 1;
            }
        }elseif(Yii::$app->request->post('flag') == 'p'){
            $paging = Pages::p($p,Yii::$app->request->post('u_keyword'));
            echo json_encode($paging);
        }else{
            $paging = Pages::p($p);
            // $users = Users::find()->orderBy('uname')->where('status = 0')->asArray()->all();
            $model = new Users;
            return $this->render('index',['model'=>$model,'paging'=>$paging]);
        }
    }
    /**
     * add & modify
     * @return [type] [description]
     */
    public function actionAdd()
    {
        // $this->layout = 'main1';
        $model = new Users;
        //修改
        if(Yii::$app->request->post('uid'))
        {
            // $file = UploadedFile::getInstance($model, 'headerimg');
            // $file->saveAs('../web/uploads/'.$file->basename.'.'.$file->extension);
            $new_name = 'uploads/'.time();
            $name = $this->makePic($_FILES,$new_name);
            $data = Yii::$app->request->post();

            // print_r($data);die;
            $u = Users::findOne(Yii::$app->request->post('uid'));
            // die;
            $u->uname = $data['Users']['uname'];

            $u->password = $data['Users']['password'];
            $u->gender = $data['Users']['gender'];
            $u->number = $data['Users']['number'];
            $u->idmumber = $data['Users']['idmumber'];
            $u->email = $data['Users']['email'];
            $u->registrationtime = time();
            $u->headerimg = $name;
            if($u->save() > 0)
            {
                echo "修改成功";
                header('refresh:1;url='.Url::to(['users/index']));
            }else{
                echo "修改失败";
                header('refresh:1;url='.Url::to(['users/index']));
            }
            die;
        }
        if($model->load(Yii::$app->request->post()) && $model->validate())
        {
            //图片压缩
            // print_r($_FILES);die;
            
            // $file = UploadedFile::getInstance($model, 'headerimg');
            // $file->saveAs('../web/uploads/'.$file->basename.'.'.$file->extension);
            $new_name = 'uploads/'.time();
            $name = $this->makePic($_FILES,$new_name);
            $data = Yii::$app->request->post();
            $u = new Users;
            $u->uname = $data['Users']['uname'];
            $u->password = $data['Users']['password'];
            $u->gender = $data['Users']['gender'];
            $u->number = $data['Users']['number'];
            $u->idmumber = $data['Users']['idmumber'];
            $u->email = $data['Users']['email'];
            $u->registrationtime = time();
            $u->headerimg = $name;//暂时显示一下
            if($u->save() > 0)
            {
                echo "添加成功";
                header('refresh:1;url='.Url::to(['users/index']));
            }else{
                echo "添加失败";
                header('refresh:1;url='.Url::to(['users/add']));
            }
        }else{
            if(Yii::$app->request->get('uid'))
            {
                $userinfo = Users::findOne(Yii::$app->request->get('uid'));
                return $this->render('add',['model'=>$model,'userinfo'=>$userinfo]);
            }else{
                return $this->render('add',['model'=>$model]);                
            }
        }
    }
    /**
     * 这破玩意儿就是图片压缩的
     * @return void
     */
    public function makePic($file,$name)
    {
        $image = new PictureHandle($file['Users']['tmp_name']['headerimg']);  
        $image->percent = 0.6;  
        $image->openImage();  
        $image->thumpImage();
        $mypic = $image->saveImage($name);
        return $mypic;
    }
    /**
     * 这破玩意儿就是生成验证码的
     */
    public function actionSetcode()
    {
        session_start();
        $_vc = new ValidateCode();  //实例化一个对象
        $_vc->doimg();  
        $_SESSION['authnum_session'] = $_vc->getCode();//验证码保存到SESSION中
    }

    public function actionCheckcode()
    {
        session_start();
        error_reporting(E_ALL & ~E_NOTICE);
        $code = trim(strip_tags($_GET['code']));
        if($code !== $_SESSION['authnum_session'])
        {
            echo 123;
        }
    }
}
