<?php
/**
 * The file is part of Notadd
 *
 * @author: Hollydan<2642956839@qq.com>
 * @copyright (c) 2017, notadd.com
 * @datetime: 17-9-20 下午4:25
 */
namespace Notadd\MallGallery\Controllers;

use Notadd\Foundation\Routing\Abstracts\Controller;
use Notadd\MallGallery\Handlers\AllPictureHandler;

class PictureController extends Controller
{
    /**
     * @param AllPictureHandler $handler
     * @return \Notadd\Foundation\Passport\Responses\ApiResponse|\Psr\Http\Message\ResponseInterface|\Zend\Diactoros\Response
     */
    public function all(AllPictureHandler $handler)
    {
        return $handler->toResponse()->generateHttpResponse();
    }
}