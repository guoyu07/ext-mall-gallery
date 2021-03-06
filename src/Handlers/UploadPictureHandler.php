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
use Intervention\Image\ImageManagerStatic as Image;
use Notadd\Foundation\Routing\Abstracts\Handler;
use Notadd\MallGallery\Models\Gallery;
use Notadd\MallGallery\Models\Mall;
use Notadd\MallGallery\Models\Picture;

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

        $gallery = Gallery::query()->find($this->request->input('gallery_id'));
        if ($gallery instanceof Gallery) {
            $galleryPath = $gallery->id;
            $mallPath = $gallery->mall_id;
        } else {
            return $this->withCode(401)->withError('相册id不存在');
        }

        $img = $this->request->file('file');
        $realName = $img->getClientOriginalName();  //  文件原名
        $hash = hash_file('md5', $img->getPathname(), false);   //  加密文件

        $dictionary = base_path('public/uploads/gallery/' . $mallPath . '/' . $galleryPath);     //  文件路径
        $random = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_BOTH);
        $file = $hash . $random . '.' . $img->getClientOriginalExtension();     //  上传之后文件名
        if (!$this->files->exists($dictionary . '/' . $file)) {
            $img->move($dictionary, $file);
        }
        $path = url('uploads/gallery/' . $mallPath . '/' . $galleryPath . '/' . $file);     //  图片链接

        //将图片存到数据库
        $picture = new Picture();
        $picture->size = Image::make($dictionary . '/' . $file)->width() . 'x' . Image::make($dictionary . '/' . $file)->height();
        $picture->path = $path;
        $picture->user_id = 1;
        $picture->gallery_id = $gallery->id;
        $picture->name = $realName;
        $picture->save();

        return true;
    }
}