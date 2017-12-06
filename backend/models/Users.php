<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property integer $uid
 * @property string $uname
 * @property string $password
 * @property integer $number
 * @property string $gender
 * @property string $email
 * @property string $registrationtime
 * @property string $idmumber
 * @property string $headerimg
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['number'], 'integer'],
            [['uname', 'email'], 'string', 'max' => 50],
            ['email','email'],
            ['password','string', 'max' => 70],
            [['gender'], 'string', 'max' => 255],
            [['idmumber'], 'string', 'max' => 200],
            [['headerimg'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'uname' => '用户名',
            'password' => '密码',
            'gender' => '性别',
            'number' => '手机号',
            'email' => '邮箱',
            'idmumber' => '身份证号',
            'headerimg' => '头像',
        ];
    }
}
