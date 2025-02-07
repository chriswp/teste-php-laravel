<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'category_id',
        'title',
        'contents',
        'exercicio'
    ];

    protected $casts = [
        'exercicio' => 'integer',
        'category_id' => 'integer',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
