<?php
/**
 * Power by 湖北巨量云科技有限公司
 * Author: xiaohuoban
 * Create Date: 2021/10/22 5:52 下午
 *
 */

require_once "../vendor/autoload.php";
use juliang\api\Alone;

/**
 * 声明独享代理对象
 * trade_no和key请填写您的实际业务编号和key
 */
$aloneClient = new Alone("", "");


/**
 * action参数释义：
 * getIps： 获取独享代理详情
 * setWhiteIp：设置白名单IP
 * getWhiteIp：获取白名单IP
 * 文档地址：
 */
// 可选参数
$getIpsParams = [
    // 返回sock代理端口（不需要不传）
    'sock_port' =>  1,
    // 返回IP归属地名称（不需要不传）
    'city_name' =>  1,
    // 返回IP归属地邮政编码（不需要不传）
    'city_code' =>  1,
    // 返回IP剩余可用时长，动态型独有（单位：秒，不需要不穿）
    'ip_remain' =>  1,
    // 返回业务到期时间
    'order_endtime' =>  1
];
// requestMethod请求方式可选值：[GET|POST]
/**
 * 获取独享代理信息
 * 返回值格式为：Json
 * 文档地址：https://www.juliangip.com/help/api/alone/
 */
// $getIpsResult = $aloneClient->action($aloneClient::GET_IPS_ACTION, $getIpsParams, "POST");
// 查看结果
// var_dump($getIpsResult);


/**
 * 设置IP白名单
 * 返回值格式为：Json
 * 文档地址：https://www.juliangip.com/help/api/alone/setwhiteip/
 */
// $setWhieIpParamas = [
//     "ips"   =>  "7.7.7.7,8.8.8.8"
// ];
// $setWhiteIpResult = $aloneClient->action($aloneClient::SET_WHITE_IP_ACTION, $setWhieIpParamas);
// var_dump($setWhiteIpResult);

/**
 * 获取IP白名单
 * 返回值格式为：Json
 * 文档地址：https://www.juliangip.com/help/api/alone/getwhiteip/
 */
$getWhiteIpResult = $aloneClient->action($aloneClient::GET_WHITE_IP_ACTION);
var_dump($getWhiteIpResult);

/**
 * 替换授权IP白名单
 * 返回值格式：Json
 * 文档地址：https://www.juliangip.com/help/api/alone/replaceWhiteIp/
 */
$replaceParams = [
    // 替换的白名单IP
    'new_ip'    =>  "8.8.8.8,9.9.9.9",
    //  被替换的白名单IP
    'old_ip'    =>  "7.7.7.7,8.8.8.8",
    // 是否重置白名单（不带此参数代表不重置已经存在的白名单）
    'reset'     =>  1,
];
$replaceResult = $aloneClient->action($aloneClient::REPLACE_WHITE_IP_ACTION, $replaceParams);
var_dump($replaceResult);