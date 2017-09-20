<?php
/**
 * The file is part of Notadd
 *
 * @author: Hollydan<2642956839@qq.com>
 * @copyright (c) 2017, notadd.com
 * @datetime: 17-9-20 上午11:43
 */
namespace Notadd\Navigation\Handlers;

use Notadd\Foundation\Routing\Abstracts\Handler;
use Notadd\MallGallery\Models\Gallery;

/**
 * Class DeleteCategoryHandler.
 */
class DeleteGalleryHandler extends Handler
{
    /**
     * Execute Handler.
     *
     * @return DeleteGalleryHandler
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     * @throws \Illuminate\Validation\ValidationException
     */
    public function execute()
    {
        $this->validate($this->request, [
            'gallery_id' => 'required',
        ], [
            'gallery_id.required' => '请输入相册id',
        ]);

        $galleryId = $this->request->input('gallery_id');
        $gallery = Gallery::where('id', $galleryId)->first();
        if (!$gallery) {
            return $this->withCode(401)->withError('请重新确认相册Id是否正确');
        }

        if ($gallery->delete()) {
            return $this->withCode(200)->withMessage('删除相册成功');
        }
    }
}
