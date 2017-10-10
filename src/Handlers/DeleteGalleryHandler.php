<?php
/**
 * The file is part of Notadd
 *
 * @author: Hollydan<2642956839@qq.com>
 * @copyright (c) 2017, notadd.com
 * @datetime: 17-9-20 上午11:43
 */
namespace Notadd\MallGallery\Handlers;

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
        $gallery = Gallery::find($galleryId);
        if (!$gallery instanceof Gallery) {
            return $this->withCode(401)->withError('请重新确认相册Id是否正确');
        }

        //删除相册文件夹
        $pictures = $gallery->pictures;
        if ($pictures->count() > 0) {

            //先删除文件夹下面的图片
            foreach ($pictures as $pic) {
                $path = base_path('statics' . strstr($pic->path, '/uploads'));
                if ($this->container->make('files')->exists($path)) {
                    $this->container->make('files')->delete($path);
                }
            }

            //再删除空文件夹
            $imgDictionary = base_path('statics/uploads/gallery/' . $gallery->mall_id . '/' . $galleryId);
            if ($this->container->make('files')->exists($imgDictionary)) {
                rmdir($imgDictionary);
            }
        }


        if ($gallery->delete()) {
            return $this->withCode(200)->withMessage('删除相册成功');
        }
    }
}
