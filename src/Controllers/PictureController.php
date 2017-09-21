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
use Notadd\MallGallery\Handlers\DeletePictureHandler;
use Notadd\Slide\Handlers\UploadPictureHandler;

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

    /**
     * @param UploadPictureHandler $handler
     * @return \Notadd\Foundation\Passport\Responses\ApiResponse|\Psr\Http\Message\ResponseInterface|\Zend\Diactoros\Response
     */
    public function set(UploadPictureHandler $handler)
    {
        return $handler->toResponse()->generateHttpResponse();
    }

    /**
     * @param DeletePictureHandler $handler
     * @return \Notadd\Foundation\Passport\Responses\ApiResponse|\Psr\Http\Message\ResponseInterface|\Zend\Diactoros\Response
     */
    public function delete(DeletePictureHandler $handler)
    {
        return $handler->toResponse()->generateHttpResponse();
    }
}