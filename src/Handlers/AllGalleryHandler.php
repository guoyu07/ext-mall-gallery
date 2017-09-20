<?php
/**
 * The file is part of Notadd
 *
 * @author: Hollydan<2642956839@qq.com>
 * @copyright (c) 2017, notadd.com
 * @datetime: 17-9-20 上午11:33
 */

namespace Notadd\Navigation\Handlers;

use Notadd\Foundation\Routing\Abstracts\Handler;
use Notadd\MallGallery\Models\Gallery;

/**
 * Class AllCategoryHandler.
 */
class AllGalleryHandler extends Handler
{
    /**
     * Execute Handler.
     *
     * @throws \Exception
     */
    protected function execute()
    {
        $this->validate($this->request,[
            'gallery_perpage' => 'required',
        ],[
            'gallery_perpage.required' => '请输入每页显示条数',
        ]);

        $perPage = $this->request->get('gallery_perpage');
        $galleries = Gallery::OrderBy('created_at', 'desc')->paginate($perPage)->toArray();

        return $this->withCode(200)->withData($galleries)->withMessage('获取数据成功！');
    }
}
