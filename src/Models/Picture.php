<?php
/**
 * The file is part of Notadd
 *
 * @author: Hollydan<2642956839@qq.com>
 * @copyright (c) 2017, notadd.com
 * @datetime: 17-9-20 上午11:27
 */

namespace Notadd\MallGallery\Models;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    protected $table = 'ext_mall_gallery_pictures';

    protected $fillable = [
        'name',
        'size',
        'path',
        'description',
        'user_id',
        'gallery_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gallery()
    {
        return $this->belongsTo('Notadd\MallGallery\Models\Gallery');
    }
}