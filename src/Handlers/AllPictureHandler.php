<?php
/**
 * The file is part of Notadd
 *
 * @author: Hollydan<2642956839@qq.com>
 * @copyright (c) 2017, notadd.com
 * @datetime: 17-9-20 上午11:39
 */

namespace Notadd\MallGallery\Handlers;

use Notadd\Foundation\Routing\Abstracts\Handler;
use Notadd\MallGallery\Models\Picture;

/**
 * Class AllPictureHandler
 * @package Notadd\MallGallery\Handlers
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
        //图片排序
        $order = $this->request->get('picture_order', 1);
        switch ($order) {
            case 1:     //按上传时间从晚到早
                $order = 'created_at';
                $destination = 'desc';
                break;
            case 2:     //按上传时间从早到晚
                $order = 'created_at';
                $destination = 'asc';
                break;
            case 3:     //按图片从大到小
                $order = 'size';
                $destination = 'desc';
                break;
            case 4:     //按图片从小到大
                $order = 'size';
                $destination = 'asc';
                break;
            case 5:     //按图片名
                $order = 'name';
                $destination = 'asc';
                break;
        }

        $perPage = $this->request->get('picture_perpage', 20);
        $pictures = Picture::OrderBy($order, $destination)->paginate($perPage);

        return $this->withCode(200)->withData($pictures)->withMessage('获取数据成功！');
    }
}
