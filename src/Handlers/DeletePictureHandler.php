<?php
/**
 * The file is part of Notadd
 *
 * @author: Hollydan<2642956839@qq.com>
 * @copyright (c) 2017, notadd.com
 * @datetime: 17-9-20 下午2:03
 */
namespace Notadd\MallGallery\Handlers;

use Illuminate\Container\Container;
use Illuminate\Filesystem\Filesystem;
use Notadd\Foundation\Routing\Abstracts\Handler;
use Notadd\MallGallery\Models\Picture;

/**
 * Class DeleteCategoryHandler.
 */
class DeletePictureHandler extends Handler
{

    protected $file;

    /**
     * DeletePictureHandler constructor.
     * @param Container $container
     * @param Filesystem $filesystem
     */
    public function __construct(Container $container, Filesystem $filesystem)
    {
        parent::__construct($container);
        $this->file = $filesystem;
    }

    /**
     * Execute Handler.
     *
     * @return DeletePictureHandler
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     * @throws \Illuminate\Validation\ValidationException
     */
    public function execute()
    {
        $this->validate($this->request, [
            'picture_id' => 'required',
        ], [
            'picture_id.required' => '请传入图片id',
        ]);

        $pictureId = $this->request->get('picture_id');
        $picture = Picture::find($pictureId);

        if (!$picture instanceof Picture) {
            return $this->withCode(401)->withError('请重新确认图片id是否存在');
        }

        $subPath = strstr($picture->path, '/uploads');
        $completePath = base_path('statics' . $subPath);
        if ($this->file->exists($completePath)) {
            $this->file->delete($completePath);
        }

        if ($picture->delete()) {
            return $this->withCode(200)->withMessage('删除图片成功');
        }
    }
}
