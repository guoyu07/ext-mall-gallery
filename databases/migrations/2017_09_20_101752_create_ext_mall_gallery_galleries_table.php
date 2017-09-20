<?php
/**
 * This file is part of Notadd.
 *
 * @datetime 2017-09-20 10:17:52
 */

use Illuminate\Database\Schema\Blueprint;
use Notadd\Foundation\Database\Migrations\Migration;

/**
 * Class CreateExtMallGalleryGalleriesTable.
 */
class CreateExtMallGalleryGalleriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!$this->schema->hasTable('ext_mall_gallery_galleries')) {
            $this->schema->create('ext_mall_gallery_galleries', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id')->comment('相册ID');
                $table->string('name')->comment('相册名称');
                $table->string('cover')->nullable()->comment('相册封面');
                $table->string('order')->nullable()->comment('相册排序');
                $table->string('description')->nullable()->comment('相册描述');
                $table->integer('user_id')->comment('图片上传用户id');
                $table->unsignedInteger('mall_id')->comment('相册所属店铺');
                $table->foreign('mall_id')->references('id')->on('ext_mall_gallery_malls')->onDelete('cascade');
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
        $this->schema->drop('ext_mall_gallery_galleries');
    }
}
