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
        $this->json('post', 'api/mall_gallery/gallery/set', ['mall_id' => 1, 'gallery_name' => 'gallery1'])
            ->assertStatus(200);
    }

    /**
     * @test
     */
    public function deleteGallery()
    {
        $this->json('post', 'api/mall_gallery/gallery/delete', ['gallery_id' => 1])
            ->assertStatus(200);
    }

    /**
     * @test
     */
    public function updateGallery()
    {
        $this->json('post', 'api/mall_gallery/gallery/update', ['gallery_id' => 1, 'gallery_name' => 'gallery111'])
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