<?php
/**
 * The file is part of Notadd
 *
 * @author: Hollydan<2642956839@qq.com>
 * @copyright (c) 2017, notadd.com
 * @datetime: 17-9-20 上午11:55
 */

namespace Notadd\MallGallery\Handlers;

use Notadd\Foundation\Routing\Abstracts\Handler;
use Notadd\MallGallery\Models\Gallery;

/**
 * Class AllCategoryHandler.
 */
class ShowGalleryHandler extends Handler
{
    /**
     * Execute Handler.
     *
     * @throws \Exception
     */
    protected function execute()
    {
        $this->validate($this->request,[
            'gallery_id' => 'required',
        ],[
            'gallery_id.required' => '请传入相册id',
        ]);

        $galleryId = $this->request->get('gallery_id');
        $perPage = $this->request->get('gallery_perpage', 20);
        $gallery = Gallery::find($galleryId);
        if ($gallery instanceof Gallery) {
            $pictures = $gallery->pictures()->paginate($perPage);
        } else {
            return $this->withCode(401)->withError('相册id不存在');
        }
        return $this->withCode(200)->withData($pictures)->withMessage('获取数据成功！');
    }
}
