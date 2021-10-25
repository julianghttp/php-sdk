# 巨量HTTP_PHP-SDK

## 调用API
### 独享代理调用示例 alone_test.php

```php
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
 */
$getIpsResult = $aloneClient->action($aloneClient::GET_IPS_ACTION, $getIpsParams, "POST");
// 查看结果
var_dump($getIpsResult);
```

### 动态代理调用示例 dynamic_test.php
```php
/**
 * 声明独享代理对象
 * trade_no、num、key请填写您的实际业务编号和key
 */
$dynamicClient = new Dynamic("", 10, "");


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
 */
$getIpsResult = $dynamicClient->action($dynamicClient::GET_IPS_ACTION, $getIpsParams, "POST");
// 查看结果
var_dump($getIpsResult);


/**
 * 设置IP白名单
 * 返回值格式为：Json
 */
$setWhiteIpParams = [
    "ips"   =>  "7.7.7.7,8.8.8.8"
];
$setWhiteIpResult = $dynamicClient->action($dynamicClient::SET_WHITE_IP_ACTION, $setWhiteIpParams);
var_dump($setWhiteIpResult);

/**
 * 获取IP白名单
 * 返回值格式为：Json
 */
$getWhiteIpResult = $dynamicClient->action($dynamicClient::GET_WHITE_IP_ACTION);
var_dump($getWhiteIpResult);

/**
 * 检查代理有效性
 * 返回值格式为：Json
 */
$checkParams = [
    'proxy'   =>  "120.11.149.170:35194,110.244.145.107:55628"
];
$proxyCheckResult = $dynamicClient->action($dynamicClient::PROXY_CHECK_ACTION, $checkParams);
var_dump($proxyCheckResult);

/**
 * 获取代理IP剩余可用时长
 * 返回值格式为：Json
 */
$remainParams = [
    'proxy'   =>  "120.11.149.170:35194,110.244.145.107:55628"
];
$remainResult = $dynamicClient->action($dynamicClient::GET_PROXY_REMAIN, $remainParams);
var_dump($remainResult);

/**
 * 获取业务剩余可提取IP数量
 * 返回值格式为：Json
 */
$getProxyBalanceResult = $dynamicClient->action($dynamicClient::GET_PROXY_BALANCE);
var_dump($getProxyBalanceResult);

```



### 用户信息调用示例  users_test.php

```php
/**
 * 声明用户对象
 * userId和key请填写您的实际账号ID和key
 * 获取地址：https://www.juliangip.com/users/profile
 */
$userClient = new Users("", "");


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
```



## 技术支持
如果您发现代码有任何问题, 请提交`Issue`。

欢迎提交`Pull request`以使代码样例更加完善。

获取更多关于调用API和代理服务器使用的资料，请参考[开发者指南](http://www.juliangip.com/help/dev/dev/)。

* 技术支持微信：<a href="https://oss.juliangip.com/attachment/20210813/8c36a7f11b4d430e9953a5d7149692cb.jpg">juliangip</a>
* 技术支持QQ：<a href="http://wpa.qq.com/msgrd?v=3&uin=123919330&site=qq&menu=yes">123919330</a>
