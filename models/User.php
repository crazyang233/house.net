<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $rand
 * @property integer $start
 * @property string $nickname
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password', 'rand'], 'required'],
            [['start'], 'integer'],
            [['username', 'password', 'nickname'], 'string', 'max' => 50],
            [['rand'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'rand' => 'Rand',
            'start' => 'Start',
            'nickname' => 'Nickname',
        ];
    }

    public static function ajaxpages($p)
    {
        echo '当前页是'.$p;die;
        $psize = 2;
        $count = Users::find()->count();
        $total_p = ceil($count/$psize);
    }
}
