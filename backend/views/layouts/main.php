<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use yii\web\Cookie;
use yii\web\Controller;
use yii\helpers\Url;
AppAsset::register($this);
$cookie = \yii::$app->request->cookies;
$username = $cookie->getValue('name','null');
$id = $cookie->getValue('id','null');

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap"></div>
<!--  顶部-->
        <link rel="stylesheet" href="/assets/ad83b69/css/bootstrap.css" type="text/css">
        <link href="admin/css/public.css" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="admin/js/jquery.min.js"></script>
        <script type="text/javascript" src="admin/js/global.js"></script>
    <div id="dcWrap"> <div id="dcHead">
            <div id="head">
                <div class="logo"><a href="index.html"><img src="admin/images/dclogo.gif" alt="logo"></a></div>
                <div class="nav">
                    <ul>
                        <li class="M"><a href="JavaScript:void(0);" class="topAdd">新建</a>
                            <div class="drop mTopad"><a href="product.php?rec=add">商品</a> <a href="article.php?rec=add">文章</a> <a href="nav.php?rec=add">自定义导航</a> <a href="show.html">首页幻灯</a> <a href="page.php?rec=add">单页面</a> <a href="manager.php?rec=add">管理员</a> <a href="link.html"></a> </div>
                        </li>
                        <li><a href="../index.php" target="_blank">查看站点</a></li>
                        <li><a href="index.php?rec=clear_cache">清除缓存</a></li>
                        <li><a href="http://help.douco.com" target="_blank">帮助</a></li>
                        <li class="noRight"><a href="module.html">DouPHP+</a></li>
                    </ul>
                    <ul class="navRight">
                        <li class="M noLeft"><a href="JavaScript:void(0);">您好，<?=$username?>欢迎回来工作</a>
                            <div class="drop mUser">
                                <a href="?r=home/individual&id=<?=$id?>">编辑我的个人资料</a>

                                <a href="manager.php?rec=cloud_account">设置云账户</a>
                            </div>
                        </li>
                        <li class="noRight"><a href="?r=login/log-out">退出</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div id="dcLeft"><div id="menu">
                <ul class="top">
                    <li><a href="index.html"><i class="home"></i><em>管理首页</em></a></li>
                </ul>
                <ul>
                    <li><a href="system.html"><i class="system"></i><em>系统设置</em></a></li>
                    <li><a href="?r=homewners/index"><i class="nav"></i><em>添加房间系统</em></a></li>
                    <li><a href="show.html"><i class="show"></i><em>首页幻灯广告</em></a></li>
                    <li><a href="page.html"><i class="page"></i><em>单页面管理</em></a></li>
                </ul>
                <ul>
                    <li><a href="product_category.html"><i class="productCat"></i><em>商品分类</em></a></li>
                    <li><a href="product.html"><i class="product"></i><em>商品列表</em></a></li>
                </ul>
                <ul>
                    <li><a href="article_category.html"><i class="articleCat"></i><em>文章分类</em></a></li>
                    <li><a href="article.html"><i class="article"></i><em>文章列表</em></a></li>
                </ul>
                <ul>
                    <li><a href="<?= Url::to(['users/index'])?>"><i class="manager"></i><em>用户列表</em></a></li><!--展示和修改、删除一起-->
                    <li><a href="<?= Url::to(['users/add'])?>"><i class="manager"></i><em>用户添加</em></a></li>
                </ul>
                <ul class="bot">
                    <li><a href="backup.html"><i class="backup"></i><em>数据备份</em></a></li>
                    <li><a href="mobile.html"><i class="mobile"></i><em>手机版</em></a></li>
                    <li><a href="theme.html"><i class="theme"></i><em>设置模板</em></a></li>
                    <li><a href="manager.html"><i class="manager"></i><em>网站管理员</em></a></li>
                    <li><a href="manager.php?rec=manager_log"><i class="managerLog"></i><em>操作记录</em></a></li>
                </ul>
            </div></div>
        <div id="dcMain"> <!-- 当前位置 -->
            <div id="urHere">DouPHP 管理中心</div>  <div id="index" class="mainBox" style="padding-top:18px;height:auto!important;height:550px;min-height:550px;">

                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
                <?= Alert::widget() ?>
                <?= $content ?>
            </div>

    <!--  顶部-->
    <div class="container">




</div>
</div>
        </body>
<footer class="footer">
    <div id="footer">
        <div class="line"></div>
        <ul>
            版权所有 © 2013-2015 漳州豆壳网络科技有限公司，并保留所有权利。
        </ul>
    </div>
    </div><!-- dcFooter 结束 -->
</footer>


