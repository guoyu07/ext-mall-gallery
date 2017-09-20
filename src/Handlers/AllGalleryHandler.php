<?php
/**
 * The file is part of Notadd
 *
 * @author: Hollydan<2642956839@qq.com>
 * @copyright (c) 2017, notadd.com
 * @datetime: 17-9-20 上午11:33
 */

namespace Notadd\MallGallery\Handlers;

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
        $order = $this->request->get('gallery_order', 3);
        switch ($order) {
            case 0:    //按从大到小
                $orderBy = 'order';
                $destination ='desc';
                break;
            case 1:     //按从小到大
                $orderBy = 'order';
                $destination ='asc';
                break;
            case 2:     //按创建时间从早到晚
                $orderBy = 'created_at';
                $destination = 'asc';
                break;
            case 3:     //按创建时间从晚到早
                $orderBy = 'created_at';
                $destination = 'desc';
                break;
            case 4:     //按相册名
                $orderBy = 'name';
                $destination = 'desc';
                break;

        }
        $galleries = Gallery::with('mall')->withCount('pictures')->OrderBy($orderBy, $destination)->paginate($perPage);

        return $this->withCode(200)->withData($galleries)->withMessage('获取数据成功！');
    }
}
