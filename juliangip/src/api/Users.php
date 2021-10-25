<?php
/**
 * Power by 湖北巨量云科技有限公司
 * Author: xiaohuoban
 * Create Date: 2021/10/23 5:45 下午
 *
 */

namespace juliang\api;

use juliang\utils\HttpKit;
use juliang\utils\ResponseKit;
use juliang\utils\SignKit;

class Users {

    // 用户ID
    private $userId;
    // 用户密钥
    private $key;
    /**
     * 获取账户余额
     */
    CONST GET_BALANCE_ACTION = "getBalance";

    public function __construct($userId, $key)
    {
        $this->userId = $userId;
        $this->key = $key;
    }

    /**
     * 执行操作
     * @param string $action
     * @param array $params
     * @param string $requestMethod
     * @return mixed|void
     */
    public function action(string $action, array $params = [], string $requestMethod = "GET")
    {
        // 获取对应Api
        $apiUrl = $this->getApiUrlByAction($action);
        if (empty($apiUrl)) {
            return ResponseKit::apiReturn(['code' => 400, 'msg' => "暂不支持此操作，请参照代码示例修改"]);
        }
        $params['user_id'] = $this->userId;
        $params['sign'] = SignKit::md5Sign($params, $this->key);
        $getIpsResult = HttpKit::sendRequest($apiUrl, $params, $requestMethod);
        if (true === $getIpsResult['ret']) {
            return $getIpsResult['data'];
        }
        return ResponseKit::apiReturn(['code' => 400, 'msg' => $getIpsResult['msg']]);
    }

    /**
     * 通过action获取对应的API地址
     * @param string $action
     * @return string
     */
    private function getApiUrlByAction(string $action): string
    {
        switch ($action) {
            case self::GET_BALANCE_ACTION:
                $apiUrl = "http://v1.api.juliangip.com/v1/users/getbalance";
                break;
            default:
                $apiUrl = "";
        }
        return $apiUrl;
    }
}