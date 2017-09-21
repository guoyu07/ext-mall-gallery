<?php
/**
 * The file is part of Notadd
 *
 * @author: Hollydan<2642956839@qq.com>
 * @copyright (c) 2017, notadd.com
 * @datetime: 17-9-20 下午8:50
 */

namespace Notadd\MallGallery\Listeners;

use Notadd\Foundation\Routing\Abstracts\RouteRegister as AbstractRouteRegister;
use Notadd\MallGallery\Controllers\GalleryController;
use Notadd\MallGallery\Controllers\PictureController;

/**
 * Class RouteRegister.
 */
class RouteRegister extends AbstractRouteRegister
{
    /**
     * Handle Route Register.
     */
    public function handle()
    {
        $this->router->group(['middleware' => ['cross', 'web'], 'prefix' => 'api/mall_gallery'], function () {

                $this->router->group(['prefix' => 'picture'], function() {
                    $this->router->post('list', PictureController::class.'@all');
                    $this->router->post('set', PictureController::class.'@set');
                    $this->router->post('delete', PictureController::class.'@delete');
                    $this->router->post('deletes', PictureController::class.'@deletes');
                    $this->router->post('mark', PictureController::class.'@mark');
                });

                $this->router->group(['prefix' => 'gallery'], function () {
                    $this->router->post('list', GalleryController::class.'@all');
                    $this->router->post('set', GalleryController::class.'@set');
                    $this->router->post('delete', GalleryController::class.'@delete');
                    $this->router->post('update', GalleryController::class.'@update');
                    $this->router->post('show', GalleryController::class.'@show');
                });
        });
    }
}
