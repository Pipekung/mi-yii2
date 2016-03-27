<?php

namespace app\components;

use Yii;
use yii\base\Component;
use yii\db\Query;

class UserRole extends Component {

	public static function is($roleName) {
		$roleUser = self::getRole();
		return in_array($roleName, $roleUser);
	}

	public static function getRole($userId = null) {
		$userId = isset($userId) ? $userId : Yii::$app->user->id;
		$result = (new Query)
			->select('item_name')
			->from('auth_assignment')
			->where([
				'user_id' => $userId,
			])
			->column()
		;
		return $result;
	}

}