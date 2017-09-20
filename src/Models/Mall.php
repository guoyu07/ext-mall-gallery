<?php
/**
 * The file is part of Notadd
 *
 * @author: Hollydan<2642956839@qq.com>
 * @copyright (c) 2017, notadd.com
 * @datetime: 17-9-20 上午11:25
 */

namespace Notadd\MallGallery\Models;

use Illuminate\Database\Eloquent\Model;

class Mall extends Model
{
    protected $table = 'ext_mall_gallery_malls';

    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function galleries()
    {
        return $this->hasMany('Notadd\MallGallery\Models\Gallery');
    }
}