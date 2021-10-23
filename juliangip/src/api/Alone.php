<?php
/**
 * Power by 湖北巨量云科技有限公司
 * Author: xiaohuoban
 * Create Date: 2021/10/22 4:26 下午
 *
 */

namespace juliang\api;

use juliang\utils\HttpKit;
use juliang\utils\ResponseKit;
use juliang\utils\SignKit;

class Alone {

    // 业务编号
    private $trade_no;
    // 业务密钥
    private $key;

    // 获取代理信息操作
    CONST GET_IPS_ACTION = "getIps";

    // 设置IP白名单操作
    CONST SET_WHITE_IP_ACTION = "setWhiteIp";

    // 获取IP白名单
    CONST GET_WHITE_IP_ACTION = "getWhiteIp";

    /**
     * 获取独享代理信息初始化
     * @param string $trade_no
     * @param string $key
     */
    public function __construct(string $trade_no, string $key)
    {
        $this->trade_no = $trade_no;
        $this->key = $key;
    }

    /**
     * 获取代理信息
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
        $params['trade_no'] = $this->trade_no;
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
            case self::GET_IPS_ACTION:
                $apiUrl = "http://v1.api.juliangip.com/v1/alone/getips";
                break;
            case self::SET_WHITE_IP_ACTION:
                $apiUrl = "http://v1.api.juliangip.com/v1/alone/setwhiteip";
                break;
            case self::GET_WHITE_IP_ACTION:
                $apiUrl = "http://v1.api.juliangip.com/v1/alone/getwhiteip";
                break;
            default:
                $apiUrl = "";
        }
        return $apiUrl;
    }
}