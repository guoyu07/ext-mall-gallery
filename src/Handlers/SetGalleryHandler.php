<?php
/**
 * The file is part of Notadd
 *
 * @author: Hollydan<2642956839@qq.com>
 * @copyright (c) 2017, notadd.com
 * @datetime: 17-9-20 下午2:25
 */

namespace Notadd\MallGallery\Handlers;

use Notadd\Foundation\Routing\Abstracts\Handler;
use Notadd\MallGallery\Models\Gallery;

/**
 * Class SetCategoryHandler.
 */
class SetGalleryHandler extends Handler
{
    /**
     * Execute Handler.
     *
     * @return SetGalleryHandler
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function execute()
    {
        $this->validate($this->request,[
            'gallery_name' => 'required',
        ],[
            'gallery_name.required' => '请输入相册名称',
        ]);

        $gallery = new Gallery();
        $gallery->name = $this->request->get('gallery_name');
        $gallery->user_id = 1;  //默认上传用户Id为1,管理员用户
        $gallery->order = $this->request->get('gallery_order');
        $gallery->description = $this->request->get('gallery_description');

        if ($gallery->save()) {
            return $this->withCode(200)->withMessage('相册信息保存成功');
        } else {
            return $this->withCode(401)->withError('保存相册信息失败，请稍后重试');
        }
    }
}
