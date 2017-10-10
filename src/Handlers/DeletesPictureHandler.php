<?php
/**
 * The file is part of Notadd
 *
 * @author: Hollydan<2642956839@qq.com>
 * @copyright (c) 2017, notadd.com
 * @datetime: 17-9-21 下午12:06
 */

namespace Notadd\MallGallery\Handlers;


use Illuminate\Container\Container;
use Illuminate\Filesystem\Filesystem;
use Notadd\Foundation\Routing\Abstracts\Handler;
use Notadd\MallGallery\Models\Picture;

class DeletesPictureHandler extends Handler
{

    protected $file;

    /**
     * DeletesPictureHandler constructor.
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
        ],[
            'picture_id.required' => '请传入图片id',
        ]);

        $ids = explode(',', $this->request->get('picture_id'));
        foreach ($ids as $id) {
            $picture = Picture::find($id);
            if (!$picture instanceof Picture) {
                return $this->withCode(401)->withError('未找到id为' . $id . '的图片');
            }

            $subPath = strstr($picture->path, '/uploads');
            $completePath = base_path('statics' . $subPath);
            if ($this->file->exists($completePath)) {
                $this->file->delete($completePath);
            }
            $picture->delete();
        }
        return $this->withCode(200)->withMessage('删除图片成功');
    }
}