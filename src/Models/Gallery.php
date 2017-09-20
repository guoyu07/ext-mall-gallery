<?php
/**
 * The file is part of Notadd
 *
 * @author: Hollydan<2642956839@qq.com>
 * @copyright (c) 2017, notadd.com
 * @datetime: 17-9-20 上午11:17
 */

namespace Notadd\MallGallery\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = 'ext_mall_gallery_galleries';

    protected $fillable = [
        'name',
        'cover',
        'order',
        'description',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pictures()
    {
        return $this->hasMany('Notadd\MallGallery\Models\Picture');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function mall()
    {
        return $this->belongsTo('Notadd\MallGallery\Models\Mall');
    }
}