<?php
function xml_to_array($xml){

    //禁止引用外部xml实体

    libxml_disable_entity_loader(true);

    $xmlstring = simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA);

    $val = json_decode(json_encode($xmlstring),true);

    return $val;

}


function post($curlPost,$url){
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_NOBODY, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $curlPost);
    $return_str = curl_exec($curl);
    curl_close($curl);
    return $return_str;
}

function get_sms_content($content_number = 1)
{
    if ($content_number == 1) {
        return "尊敬的经销商，2018VICTOR品牌大会暨春夏新品发布会欢迎您！请点击链接 v.xhbuy.cn/u/【变量】获取入场凭证";
    }
    if ($content_number == 2) {
        return "尊敬的经销商，欢迎晚宴于下午18:00开始，地址：南京国际青年文化中心，五楼南京厅，欢迎莅临，谢谢！";
    }
    if ($content_number == 3) {
        return "尊敬的经销商，2018VICTOR品牌大会暨春夏新品发布会于上午8:30正式开始，地址：南京国际青年文化中心，五楼南京厅，欢迎莅临，谢谢！";
    }
    if ($content_number == 4) {
        return "尊敬的经销商，南京天气：3月20日小雨转阴9-12°C；3月21日多云9-15°C；3月22日阴转暴雨12-13°C。出行请带好雨伞，注意保暖！";
    }
}