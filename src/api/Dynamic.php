<?php
/**
 * Power by 湖北巨量云科技有限公司
 * Author: xiaohuoban
 * Create Date: 2021/10/23 5:24 下午
 *
 */

namespace juliang\api;

use juliang\utils\HttpKit;
use juliang\utils\ResponseKit;
use juliang\utils\SignKit;

class Dynamic {

    // 业务编号
    private $trade_no;
    // 业务密钥
    private $key;
    // 提取数量
    private $num;

    /**
     * 提取动态IP
     */
    CONST GET_IPS_ACTION = "getIps";

    /**
     * 设置IP白名单
     */
    CONST SET_WHITE_IP_ACTION = "setWhiteIp";

    /**
     * 获取IP白名单
     */
    CONST GET_WHITE_IP_ACTION = "getWhiteIp";

    /**
     * 替换IP白名单
     */
    CONST REPLACE_WHITE_IP_ACTION = "replaceWhiteIp";

    /**
     * 校验代理有效性
     */
    CONST PROXY_CHECK_ACTION = "check";

    /**
     * 获取代理剩余有效时长
     */
    CONST GET_PROXY_REMAIN = "remain";

    /**
     * 获取代理剩余数量
     */
    CONST GET_PROXY_BALANCE = "balance";

    /**
     * 获取动态代理信息初始化
     * @param string $trade_no
     * @param int $num
     * @param string $key
     */
    public function __construct(string $trade_no, int $num, string $key)
    {
        $this->trade_no = $trade_no;
        $this->num = $num;
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
        $params['trade_no'] = $this->trade_no;
        $params['num']  = $this->num;
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
                $apiUrl = "https://v1.api.juliangip.com/dynamic/getips";
                break;
            case self::SET_WHITE_IP_ACTION:
                $apiUrl = "https://v1.api.juliangip.com/dynamic/setwhiteip";
                break;
            case self::GET_WHITE_IP_ACTION:
                $apiUrl = "https://v1.api.juliangip.com/dynamic/getwhiteip";
                break;
            case self::PROXY_CHECK_ACTION:
                $apiUrl = "https://v1.api.juliangip.com/dynamic/check";
                break;
            case self::GET_PROXY_REMAIN:
                $apiUrl = "https://v1.api.juliangip.com/dynamic/remain";
                break;
            case self::GET_PROXY_BALANCE:
                $apiUrl = "https://v1.api.juliangip.com/dynamic/balance";
                break;
            case self::REPLACE_WHITE_IP_ACTION:
                $apiUrl = "https://v1.api.juliangip.com/dynamic/replaceWhiteIp";
                break;
            default:
                $apiUrl = "";
        }
        return $apiUrl;
    }



}