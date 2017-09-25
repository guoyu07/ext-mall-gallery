<?php
/**
 * The file is part of Notadd
 *
 * @author: Hollydan<2642956839@qq.com>
 * @copyright (c) 2017, notadd.com
 * @datetime: 17-9-20 下午2:44
 */

namespace Notadd\MallGallery\Handlers;

use Illuminate\Container\Container;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use Notadd\Foundation\Routing\Abstracts\Handler;
use Notadd\MallGallery\Models\Gallery;
use Notadd\MallGallery\Models\Mall;
use Notadd\MallGallery\Models\Picture;
use Intervention\Image\ImageManagerStatic as Image;

/**
 * Class UploadHandler.
 */
class UploadPictureHandler extends Handler
{
    /**
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;

    /**
     * UploadPictureHandler constructor.
     * @param Container $container
     * @param Filesystem $filesystem
     */
    public function __construct(Container $container, Filesystem $filesystem)
    {
        parent::__construct($container);
        $this->messages->push($this->translator->trans('上传图片成功！'));
        $this->files = $filesystem;
    }

    public function execute()
    {

        $this->validate($this->request, [
            'gallery_id' => 'required',
            'file' => 'required|image',
        ], [
            'gallery_id.required' => '请传入相册id',
            'file.image' => '上传文件格式必须为图片格式！',
            'file.required' => '请选择图片',
        ]);

        $galleryId = $this->request->get('gallery_id');
        $gallery = Gallery::find($galleryId);
        if ($gallery) {
            $galleryPath = $gallery->id;
            $mallId = $gallery->mall_id;
        }

        $mall = Mall::find($mallId);
        $mallPath = $mall->id;

        $img = $this->request->file('file');
        $realName = $img->getClientOriginalName();  //  文件原名
        $error = $img->getError();
        $hash = hash_file('md5', $img->getPathname(), false);   //  加密文件

        $dictionary = base_path('statics/uploads/' . $mallPath . $galleryPath);     //  文件路径
        $random = random_int(0, 9999999);
        $file = Str::substr($hash, 0, 32) . $random . '.' . $img->getClientOriginalExtension();     //  上传之后文件名
        if (!$this->files->exists($dictionary . DIRECTORY_SEPARATOR . $file)) {
            $img->move($dictionary, $file);
        }
        $path = url($dictionary . DIRECTORY_SEPARATOR . $file);     //  图片链接

        //将图片存到数据库
        $picture = new Picture();
        $picture->path = $path;
        $picture->user_id = 1;
        $picture->gallery_id = $gallery->id;
        $picture->name = $realName;
        $picture->size = Image::make($path)->width() . 'x' . Image::make($path)->height();
        $picture->save();

        return true;
    }
}