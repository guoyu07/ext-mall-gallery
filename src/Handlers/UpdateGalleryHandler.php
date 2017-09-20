<?php
/**
 * The file is part of Notadd
 *
 * @author: Hollydan<2642956839@qq.com>
 * @copyright (c) 2017, notadd.com
 * @datetime: 17-9-20 下午2:32
 */

namespace Notadd\MallGallery\Handlers;

use Notadd\Foundation\Routing\Abstracts\Handler;
use Notadd\MallGallery\Models\Gallery;

/**
 * Class UpdateCategoryHandler.
 */
class UpdateGalleryHandler extends Handler
{
    /**
     * Execute Handler.
     */
    public function execute()
    {
        $this->validate($this->request, [
            'gallery_id' => 'required',
            'gallery_name' => 'required',
        ], [
            'gallery_id.required' => '请传入相册id',
            'gallery_name.required' => '请输入相册名称',
        ]);

        $gallery = Gallery::find($this->request->get('gallery_id'));
        if ($gallery instanceof Gallery) {
            $gallery->name = $this->request->get('gallery_name');
            $gallery->order = $this->request->get('gallery_order');
            $gallery->description = $this->request->get('gallery_description');
        } else {
            return $this->withCode(401)->withError('未找到此id相册');
        }

        if ($gallery->save()) {
            return $this->withCode(200)->withMessage('更新相册信息成功');
        } else {
            return $this->withCode(402)->withError('更新相册信息失败');
        }
    }
}
