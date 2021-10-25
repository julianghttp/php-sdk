<?php
/**
 * Power by 湖北巨量云科技有限公司
 * Author: xiaohuoban
 * Create Date: 2021/9/17 5:07 下午
 *
 */

namespace juliang\utils;

class SignKit {

    protected static $postCharset = "UTF-8";
    protected static $fileCharset = "UTF-8";

    /**
     * MD5 加密
     * @param array $params
     * @param string $secret
     * @return string
     */
    public static function md5Sign(array $params, string $secret): string
    {
        return md5(self::getSignContent($params) . '&key=' . $secret);
    }

    /**
     * 获取加签字符串
     * @param $params
     * @return string
     */
    protected static function getSignContent($params): string
    {
        unset($params['sign']); // 删除Sign
        ksort($params);
        $stringToBeSigned = "";
        $i = 0;
        foreach ($params as $k => $v) {
            if (false === self::checkEmpty($v) && "@" != substr($v, 0, 1)) {
                // 转换成目标字符集
                $v = self::character($v, self::$postCharset);
                if ($i == 0) {
                    $stringToBeSigned .= "$k" . "=" . "$v";
                } else {
                    $stringToBeSigned .= "&" . "$k" . "=" . "$v";
                }
                $i++;
            }
        }
        unset ($k, $v);
        return $stringToBeSigned;
    }

    /**
     * 检验Sign
     * @param $params
     * @param $secret
     * @return bool
     */
    public function requestSignVerify($params,$secret): bool
    {
        $sign = $params['sign'];
        unset($params['sign']);
        unset($params['sign_type']);
        return $sign == $this->md5Sign($params,$secret);
    }


    protected function getMillisecond(): float
    {
        list($s1, $s2) = explode(' ', microtime());
        return (float)sprintf('%.0f', (floatval($s1) + floatval($s2)) * 1000);
    }


    /**
     * 转换字符集编码
     * @param $data
     * @param $targetCharset
     * @return string
     */
    protected static function character($data, $targetCharset): string
    {
        if (!empty($data)) {
            $fileType = self::$fileCharset;
            if (strcasecmp($fileType, $targetCharset) != 0) {
                $data = mb_convert_encoding($data, $targetCharset);
            }
        }
        return $data;
    }


    /**
     * 校验$value是否非空
     *  if not set ,return true;
     *    if is null , return true;
     **/
    protected static function checkEmpty($value): bool
    {
        if (!isset($value))
            return true;
        if (trim($value) === "")
            return true;
        return false;
    }
}