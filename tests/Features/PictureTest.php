<?php
/**
 * The file is part of Notadd
 *
 * @author: Hollydan<2642956839@qq.com>
 * @copyright (c) 2017, notadd.com
 * @datetime: 17-10-17 下午11:53
 */

namespace Tests\Features;


use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PictureTest extends TestCase
{
    /**
     * @test
     */
    public function allPicture()
    {
        $this->json('post', 'api/mall_gallery/picture/list')
            ->assertStatus(200);
    }

    /**
     * @test
     */
    public function createPicture()
    {
        Storage::fake('images');

        $this->json('post', 'api/mall_gallery/picture/set', [
            'file' => UploadedFile::fake()->image('file.jpg'),
            'gallery_id' => 1,
        ])
            ->assertStatus(200);
        Storage::disk('images')->assertExists('file.jpg');
    }

    /**
     * @test
     */
    public function deletePicture()
    {
        $this->json('post', 'api/mall_gallery/picture/delete', ['picture_id' => 1])
            ->assertStatus(200);
    }

    /**
     * @test
     */
    public function deletesPicture()
    {
        $this->json('post', 'api/mall_gallery/picture/deletes', ['picture_id' => [1, 2, 3]])
            ->assertStatus(200);
    }

    /**
     * @test
     */
    public function markPicture()
    {
        $this->json('post', 'api/mall_gallery/picture/mark', ['picture_id' => [1, 2, 3]])
            ->assertStatus(200);
    }

}