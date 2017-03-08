<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-03-08
 * Time: 上午 9:56
 */

namespace App\Admin\Extensions\Tools;

use Encore\Admin\Admin;
use Encore\Admin\Grid\Tools\AbstractTool;
use Illuminate\Support\Facades\Request;
class SendSms extends AbstractTool
{
    public $ajax_url;
    public function __construct()
    {
        $this->ajax_url = 'send_sms';
    }

    protected function script()
    {
        $path = Request::path();
        $token = csrf_token();

        return <<<EOT

$('.grid-tools-{$this->ajax_url}').on('click', function() {

    if(confirm("短信内容：（邀请你参加订货会），是否发送？")) {
        $.ajax({
            method: 'post',
            url: '{$this->ajax_url}',
            data: {
               _token:'{$token}'
            },
            beforeSend: function(){
                toastr.warning('随着发送人数增多，发送需要一段时间，不要关闭网页');
            },
            success: function () {
                toastr.success('发送成功');
            }
        });
    }
});

EOT;
    }
    public function render()
    {
        Admin::script($this->script());
        return view('admin.tools.button',
            [
                'button_name'=>'一键发送短信',
                'ajax_url'=> $this->ajax_url
            ]
        );
    }
}