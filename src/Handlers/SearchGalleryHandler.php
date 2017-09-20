<?php
/**
 * The file is part of Notadd
 *
 * @author: Hollydan<2642956839@qq.com>
 * @copyright (c) 2017, notadd.com
 * @datetime: 17-9-20 上午12:11
 */

namespace Notadd\MallGallery\Handlers;

use Notadd\Foundation\Routing\Abstracts\Handler;
use Notadd\MallGallery\Models\Gallery;
use Notadd\MallGallery\Models\Mall;

/**
 * Class AllCategoryHandler.
 */
class SearchGalleryHandler extends Handler
{
    /**
     * Execute Handler.
     *
     * @throws \Exception
     */
    protected function execute()
    {
        $this->validate($this->request,[
            'gallery_key' => 'required',
            'gallery_value' => 'required',
            'gallery_perpage' => 'required',
        ],[
            'gallery_key.required' => '请传入搜索条件',
            'gallery_value.required' => '请传入搜索内容',
            'gallery_perpage.required' => '请传入每页显示条数',
        ]);

        $galleryKey = $this->request->get('gallery_key');
        $galleryValue = $this->request->get('gallery_value');
        $perPage = $this->request->get('gallery_perpage');

        switch ($galleryKey) {
            case '相册ID':
                $galleries = Gallery::where('id', $galleryValue)->first();
                break;
            case '相册名称':
                $galleries = Gallery::where('name', $galleryValue)->paginate($perPage)->toArray();
                break;
            case '店铺ID':
                $galleries = Mall::where('id', $galleryValue)->galleries()->paginate($perPage)->toArray();
                break;
            case '店铺名称':
                $galleries = Mall::where('name', $galleryValue)->galleries()->paginate($perPage)->toArray();
                break;
        }
        if (empty($galleries)) {
            return $this->withCode(401)->withError('相册不存在');
        }
        return $this->withCode(200)->withData($galleries)->withMessage('获取数据成功！');
    }
}
