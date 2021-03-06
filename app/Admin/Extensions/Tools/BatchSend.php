<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-03-08
 * Time: 上午 10:40
 */

namespace App\Admin\Extensions\Tools;

use Encore\Admin\Grid\Tools\BatchAction;

class BatchSend extends BatchAction
{
    protected $action;
    protected $content;
    protected $content_number;

    public function __construct($action = 1,$content_number = 1)
    {
        $this->action = $action;
        $this->content_number = $content_number;
        $this->content = get_sms_content($content_number);
    }

    public function script()
    {
        return <<<EOT

$('{$this->getElementClass()}').on('click', function() {
if(confirm("短信内容：（{$this->content}），是否发送？")) {
        $.ajax({
            method: 'post',
            url: '/{$this->resource}/send_sms',
            data: {
                _token:'{$this->getToken()}',
                ids: selectedRows(),
                action: {$this->action},
                content_number: {$this->content_number}
            },
            beforeSend: function(){
                toastr.warning('随着发送人数增多，发送需要一段时间，不要关闭网页');
            },
            success: function (data) {
                if (data.errCode == 1) {
                     toastr.error('发送失败');
                }else{
                    toastr.success('发送成功');
                }
                $.pjax.reload('#pjax-container');

            }
        });
    }
});

EOT;

    }
}