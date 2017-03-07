<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-03-07
 * Time: 下午 1:35
 */

namespace App\Admin\Extensions\Tools;

use Encore\Admin\Admin;
use Encore\Admin\Grid\Tools\AbstractTool;
use Illuminate\Support\Facades\Request;

class SelectConference extends  AbstractTool
{
    protected function script()
    {
        $path = Request::path();
        $token = csrf_token();
        return <<<EOT

$('.grid-tools-vuser-card-del').on('click', function() {

    if(confirm("确定要清除所有人员的卡号信息？")) {
        $.ajax({
            method: 'get',
            url: 'del_card',
            data: {
               '_method': 'GET',
               _token:'{$token}'
            },
            success: function () {
                $.pjax({container:'#pjax-container', url: '/{$path}' });
                toastr.success('操作成功');
            }
        });
    }
});

EOT;
    }
    public function render()
    {
        Admin::script($this->script());
        return view('admin.tools.selectConference', ['button_name'=>'一键清除卡号']);
    }
}