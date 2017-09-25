<?php
/**
 * The file is part of Notadd
 *
 * @author: Hollydan<2642956839@qq.com>
 * @copyright (c) 2017, notadd.com
 * @datetime: 17-9-20 上午11:43
 */
namespace Notadd\MallGallery\Handlers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Notadd\Foundation\Routing\Abstracts\Handler;
use Notadd\MallGallery\Models\Gallery;
use PHPUnit\Util\Filesystem;

/**
 * Class DeleteCategoryHandler.
 */
class DeleteGalleryHandler extends Handler
{

    protected $filesystem;

    public function __construct(Container $container, Filesystem $filesystem)
    {
        parent::__construct($container);
        $this->filesystem = $filesystem;
    }

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
        $picture = $gallery->pictures()->first();
        $imgDictionary = base_path(Str::substr($picture->path, 0, strrpos($picture->path, '/')));
        if ($this->filesystem->exist($imgDictionary)) {
            Storage::deleteDirector($imgDictionary);
        }

        if ($gallery->delete()) {
            return $this->withCode(200)->withMessage('删除相册成功');
        }
    }
}
