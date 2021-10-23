<?php
/**
 * Power by 湖北齐天网络科技有限公司
 * Author: xiaohuoban
 * Create Date: 2021/10/23 3:01 下午
 *
 */

namespace juliang\utils;

class ResponseKit {

    /**
     * 动态代理专用返回样式
     * @access protected
     * @param array $status 基础状态码及描述
     * @param array $returnData 返回数据
     * @param String $type 要返回数据格式
     * @return void
     */
    public static function apiReturn(array $status, array $returnData = [], string $type='json') {
        $result = [
            'code'  =>  $status['code'],
            'msg'   =>  $status['msg'],
            'data'  =>  $returnData ?? ""
        ];
        switch ($type){
            case 'xml'  :
                // 返回xml格式数据
                header('Content-Type:text/xml; charset=utf-8');
                exit(self::arrayToXml($result));
            case 'text' :
                // TEXT为动态代理独有的返回类型，先声明返回类型
                header('Content-Type:text/plain; charset=utf-8');
                // 初始化为错误信息
                $resData = "ERROR（{$result['code']}）: ".$result['msg'];
                // 提取成功，则直接输出$returnData['proxy_list']即可
                if ($result['code'] === 200) {
                    $resData = $returnData['proxy_list'];
                }
                exit($resData);
            default:
                // 返回JSON数据格式到客户端 包含状态信息
                exit(json_encode($result));
        }
    }


    /**
     *   将数组转换为xml
     *   @param array $data    要转换的数组
     *   @param bool $root     是否要根节点
     *   @return string         xml字符串
     */
    private function arrayToXml(array $data, bool $root = true): string
    {
        $str="";
        if($root)$str .= "<xml>";
        foreach($data as $key => $val){
            //去掉key中的下标[]
            if (is_numeric($key)) $key = "proxy";
            if(is_array($val)){
                $child = self::arrayToXml($val, false);
                $str .= "<$key>$child</$key>";
            }else{
                $str.= "<$key>$val</$key>";
            }
        }
        if($root)$str .= "</xml>";
        return $str;
    }
}