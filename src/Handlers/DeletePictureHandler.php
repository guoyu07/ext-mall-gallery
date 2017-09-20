<?php
/**
 * The file is part of Notadd
 *
 * @author: Hollydan<2642956839@qq.com>
 * @copyright (c) 2017, notadd.com
 * @datetime: 17-9-20 下午2:03
 */
namespace Notadd\MallGallery\Handlers;

use Notadd\Foundation\Routing\Abstracts\Handler;
use Notadd\MallGallery\Models\Picture;

/**
 * Class DeleteCategoryHandler.
 */
class DeletePictureHandler extends Handler
{
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

        $pictureId = $this->request->input('picture_id');
        $pictureId = explode(',', $pictureId);
        foreach ($pictureId as $id) {
            $result = Picture::find($id)->delete();
        }

        if ($result) {
            return $this->withCode(200)->withMessage('删除图片成功');
        }
    }
}
