<?php

namespace app\models;

use app\models\Users;

/**
* 分页model
*/
class Pages
{
	public static $map = 'status = 0';//分页条件
	public static function p($p,$keyword='')
	{
		if($keyword != '')
		{
			self::$map.=" and uname like '%$keyword%'";
			// echo self::$map;die;
		}
		//总条数
		$count = Users::find()->count();
		//每页显示条数
		$psize = 3;
		//总页数
		$total_p = ceil($count/$psize);
		//页面偏移量
		$offset = ($p-1)*$psize;
		//查询数据

		// echo 'select * from users where '.self::$map." limit $offset,$psize";
		$r = Users::findBySql('select * from users where '.self::$map." order by uid asc limit $offset,$psize")->asArray()->all();
		foreach ($r as &$rr) {
			$rr['gender'] = $rr['gender'] == 0 ? '男' : '女';
			$rr['registrationtime'] = date('Y-m-d H:i:s',$rr['registrationtime']);
		}
		return [
			'p' => $p,
			'data' => $r,
			'total_p' => $total_p,
			'count' => $count,
		];
	}
}