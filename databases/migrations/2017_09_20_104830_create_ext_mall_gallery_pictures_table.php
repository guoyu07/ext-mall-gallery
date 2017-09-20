<?php
/**
 * This file is part of Notadd.
 *
 * @datetime 2017-09-20 10:48:30
 */

use Illuminate\Database\Schema\Blueprint;
use Notadd\Foundation\Database\Migrations\Migration;

/**
 * Class CreateExtMallGalleryPicturesTable.
 */
class CreateExtMallGalleryPicturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!$this->schema->hasTable('ext_mall_gallery_pictures')) {
            $this->schema->create('ext_mall_gallery_pictures', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id')->comment('图片ID');
                $table->unsignedInteger('user_id')->comment('图片上传用户id');
                $table->string('name')->comment('图片名称');
                $table->string('size')->comment('原图尺寸');
                $table->string('path')->comment('图片加密路径');
                $table->unsignedInteger('gallery_id')->comment('图片所属相册');
                $table->foreign('gallery_id')->references('id')->on('ext_mall_gallery_galleries')->onDelete('cascade');
                $table->softDeletes();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->drop('ext_mall_gallery_pictures');
    }
}
