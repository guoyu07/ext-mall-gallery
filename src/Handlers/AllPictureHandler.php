<?php
/**
 * The file is part of Notadd
 *
 * @author: Hollydan<2642956839@qq.com>
 * @copyright (c) 2017, notadd.com
 * @datetime: 17-9-20 上午11:39
 */

namespace Notadd\Navigation\Handlers;

use Notadd\Foundation\Routing\Abstracts\Handler;
use Notadd\MallGallery\Models\Picture;

/**
 * Class AllCategoryHandler.
 */
class AllPictureHandler extends Handler
{
    /**
     * Execute Handler.
     *
     * @throws \Exception
     */
    protected function execute()
    {
        $this->validate($this->request,[
            'picture_perpage' => 'required',
        ],[
            'picture_perpage.required' => '请输入每页显示条数',
        ]);

        $perPage = $this->request->get('picture_perpage');
        $pictures = Picture::OrderBy('created_at', 'desc')->paginate($perPage)->toArray();

        return $this->withCode(200)->withData($pictures)->withMessage('获取数据成功！');
    }
}
