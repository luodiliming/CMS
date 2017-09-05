<?php
/** .-------------------------------------------------------------------
 * | 函数库
 * '-------------------------------------------------------------------*/
//    url('wx.index');
//u('wx.index');   http://pay.hdphp.com/index.php?m=module/wx&action=controller/wx/index
//   $path 参数一般都长这样 ->wx.index
function url($path,array $param = []){
    $module = \houdunwang\request\Request::get('m');
        $path = str_replace('.','/',$path);
//    返回一个 URL 编码后的字符串。http_build_query()
    $args = $param ? '&'.http_build_query($param) : '';
    //新地址！！            wx/index&action=controller/wx/index
    $url = __ROOT__ . "?m={$module}&action=controller/{$path}" . $args;
    return $url;
}

//function url($path,array $param = []){
//    $module = \houdunwang\request\Request::get('m');
//    $path = str_replace('.','/',$path);
//    $args = $param ? '&'.http_build_query($param) : '';
//    $url = __ROOT__ . "?m={$module}&action=controller/{$path}" . $args;
//    return $url;
//}





