<?php
/**
 * The file is part of Notadd
 *
 * @author: Hollydan<2642956839@qq.com>
 * @copyright (c) 2017, notadd.com
 * @datetime: 17-9-20 下午3:13
 */

namespace Notadd\MallGallery\Handlers;


use Notadd\Foundation\Routing\Abstracts\Handler;
use Intervention\Image\ImageManagerStatic as Image;
use Notadd\MallGallery\Models\Picture;

class WatermarkPictureHandler extends Handler
{
    public function execute()
    {
        $this->validate($this->request, [
            'picture_id' => 'required',
        ],[
            'picture_id.required' => '请传入图片id',
        ]);

        $ids = explode(',', $this->request->get('picture_id'));
        $position = $this->request->get('position', 'bottom-right');    //  添加水印位置
        $waterMark = Image::make('watermark.jpg');  //  水印图片
        foreach ($ids as $id) {
            $picture = Picture::find($id);
            $result = Image::make($picture->path)->insert($waterMark, $position);
            if (!$picture instanceof Picture) {
                return $this->withCode(401)->withError('未找到id为' . $id . '的图片');
            }
            if (!$result) {
                return $this->withCode(402)->withError('添加水印失败');
            }
        }
        return $this->withCode(200)->withMessage('添加水印成功');
    }
}