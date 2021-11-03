<?php
/**
 * Power by 湖北巨量云科技有限公司
 * Author: xiaohuoban
 * Create Date: 2021/10/22 5:52 下午
 *
 */

require_once "../vendor/autoload.php";
use juliang\api\Dynamic;

/**
 * 声明独享代理对象
 * trade_no、num、key请填写您的实际业务编号和key
 */
$dynamicClient = new Dynamic("",10 , "");


/**
 * action 可选参数释义：
 * getIps： 获取独享代理详情
 * setWhiteIp：设置白名单IP
 * getWhiteIp：获取白名单IP
 * check：检查代理的有效性
 * remain：查看代理剩余可用时长
 * balance：获取代理剩余数量
 */
// 可选参数
$getIpsParams = [
    // 代理类型，可选参数：1、HTTP代理，2、SOCK代理
    'pt' =>  1,
    // 返回类型，可选参数：text、文本格式，json、json格式，xml、xml格式
    'result_type' =>    'json',
    // 结果分隔符，可选参数：1、\r\n，2、\n，3、空格，4、|
    'split' =>  1,
    // 返回代理IP归属地城市名称，固定值：1，不需要不带
    'city_name' =>  1,
    // 返回代理IP归属地邮政编码，固定值：1，不需要不带
    'city_code' =>  1,
    // 返回代理IP剩余可用时长，固定值：1，不需要不带
    'ip_remain' =>  1,
    // 筛选指定地区代理IP，示例值："江苏,鞍山"
    'area'      =>  "江苏,鞍山",
    // 排除指定地区代理IP，示例值："天津,黄山"
    'no_area'   =>  "天津,黄山",
    // 筛选特定开头的IP部分
    'ip_seg'    =>  "113.195.",
    // 排除特定开头的IP部分
    'no_ip_seg' =>  '27.8.',
    // 运营商筛选
    'isp'       =>  "电信",
    // IP去重，24小时内去重，固定值：1，不需要不带
    'filter'    =>  1
];
// requestMethod请求方式可选值：[GET|POST]
/**
 * 获取动态代理信息
 * 返回值格式为：Json
 * 文档地址：https://www.juliangip.com/help/api/dynamic/
 */
// $getIpsResult = $dynamicClient->action($dynamicClient::GET_IPS_ACTION, $getIpsParams, "POST");
// 查看结果
// var_dump($getIpsResult);


/**
 * 设置IP白名单
 * 返回值格式为：Json
 * 文档地址：https://www.juliangip.com/help/api/dynamic/setwhiteip/
 */
// $setWhiteIpParams = [
//     "ips"   =>  "7.7.7.7,8.8.8.8"
// ];
// $setWhiteIpResult = $dynamicClient->action($dynamicClient::SET_WHITE_IP_ACTION, $setWhiteIpParams);
// var_dump($setWhiteIpResult);

/**
 * 获取IP白名单
 * 返回值格式为：Json
 * 文档地址：https://www.juliangip.com/help/api/dynamic/getwhiteip/
 */
//$getWhiteIpResult = $dynamicClient->action($dynamicClient::GET_WHITE_IP_ACTION);
//var_dump($getWhiteIpResult);

/**
 * 检查代理有效性
 * 返回值格式为：Json
 * 文档地址：https://www.juliangip.com/help/api/dynamic/check/
 */
//$checkParams = [
//    'proxy'   =>  "120.11.149.170:35194,110.244.145.107:55628"
//];
//$proxyCheckResult = $dynamicClient->action($dynamicClient::PROXY_CHECK_ACTION, $checkParams);
//var_dump($proxyCheckResult);

/**
 * 获取代理IP剩余可用时长
 * 返回值格式为：Json
 * 文档地址：https://www.juliangip.com/help/api/dynamic/remain/
 */
//$remainParams = [
//    'proxy'   =>  "120.11.149.170:35194,110.244.145.107:55628"
//];
//$remainResult = $dynamicClient->action($dynamicClient::GET_PROXY_REMAIN, $remainParams);
//var_dump($remainResult);

/**
 * 获取业务剩余可提取IP数量
 * 返回值格式为：Json
 * 文档地址：https://www.juliangip.com/help/api/dynamic/balance/
 */
//$getProxyBalanceResult = $dynamicClient->action($dynamicClient::GET_PROXY_BALANCE);
//var_dump($getProxyBalanceResult);

/**
 * 替换授权IP白名单
 * 返回值格式：Json
 * 文档地址：https://www.juliangip.com/help/api/dynamic/replaceWhiteIp/
 */
$replaceParams = [
    // 替换的白名单IP
    'new_ip'    =>  "8.8.8.8,9.9.9.9",
    //  被替换的白名单IP
    'old_ip'    =>  "7.7.7.7,8.8.8.8",
    // 是否重置白名单（不带此参数代表不重置已经存在的白名单）
    'reset'     =>  1,
];
$replaceResult = $dynamicClient->action($dynamicClient::REPLACE_WHITE_IP_ACTION);
var_dump($replaceResult);