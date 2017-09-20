<?php
/**
 * The file is part of Notadd
 *
 * @author: Hollydan<2642956839@qq.com>
 * @copyright (c) 2017, notadd.com
 * @datetime: 17-9-10 下午5:08
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
            'gallery_perpage' => 'required',
        ],[
            'gallery_id.required' => '请传入相册id',
            'gallery_perpage.required' => '请传入每页显示条数',
        ]);

        $galleryId = $this->request->get('gallery_id');
        $perPage = $this->request->get('gallery_perpage');
        $gallery = Gallery::where('alias',$galleryId)->first();
        if ($gallery instanceof Gallery) {
            $pictures = $gallery->pictures()->paginate($perPage)->toArray();
        } else {
            return $this->withCode(401)->withError('相册id不存在');
        }
        return $this->withCode(200)->withData($pictures)->withMessage('获取数据成功！');
    }
}
