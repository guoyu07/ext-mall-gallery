<?php
/**
 * The file is part of Notadd
 *
 * @author: Hollydan<2642956839@qq.com>
 * @copyright (c) 2017, notadd.com
 * @datetime: 17-10-17 下午11:32
 */

namespace Tests\Features;


use Tests\TestCase;

class GalleryTest extends TestCase
{
    /**
     * @test
     */
    public function allGallery()
    {
        $this->json('post', 'api/mall_gallery/gallery/list')
            ->assertStatus(200);
    }

    /**
     * @test
     */
    public function createGallery()
    {
        $this->json('post', 'api/mall_gallery/gallery/set')
            ->assertStatus(200);
    }

    /**
     * @test
     */
    public function deleteGallery()
    {
        $this->json('post', 'api/mall_gallery/gallery/delete')
            ->assertStatus(200);
    }

    /**
     * @test
     */
    public function updateGallery()
    {
        $this->json('post', 'api/mall_gallery/gallery/update')
            ->assertStatus(200);
    }

    /**
     * @test
     */
    public function showGallery()
    {
        $this->json('post', 'api/mall_gallery/gallery/show')
            ->assertStatus(200);
    }

}