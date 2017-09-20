<?php
/**
 * This file is part of Notadd.
 *
 * @datetime 2017-09-20 10:16:49
 */

use Illuminate\Database\Schema\Blueprint;
use Notadd\Foundation\Database\Migrations\Migration;

/**
 * Class CreateExtMallGalleryMallsTable.
 */
class CreateExtMallGalleryMallsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!$this->schema->hasTable('ext_mall_gallery_malls')) {
            $this->schema->create('ext_mall_gallery_malls', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id')->comment('店铺ID');
                $table->string('name')->comment('店铺名称');
                $table->string('description')->nullable()->comment('店铺描述');
                $table->integer('user_id')->comment('添加店铺用户id');
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
        $this->schema->drop('ext_mall_gallery_malls');
    }
}
