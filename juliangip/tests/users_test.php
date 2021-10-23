<?php
/**
 * Power by 湖北巨量云科技有限公司
 * Author: xiaohuoban
 * Create Date: 2021/10/22 5:52 下午
 *
 */

require_once "../vendor/autoload.php";
use juliang\api\Users;

/**
 * 声明用户对象
 * userId和key请填写您的实际账号ID和key
 * 获取地址：http://www.juliangip.com/users/profile
 */
$userClient = new Users("1000004", "514a59cca7f5481ba4d7a817a866328c");


/**
 * action参数释义：
 * getBalance： 获取账户余额
 */
/**
 * 获取账号余额
 * 返回值格式为：Json
 */
$getBalanceResult = $userClient->action($userClient::GET_BALANCE_ACTION);
var_dump($getBalanceResult);