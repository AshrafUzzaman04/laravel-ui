<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class sub_category extends Model
{
    use HasFactory;

    protected $table = "sub_categories";

    protected $fillable = [
        "cat_id", "sub_catname", "sub_catslug"
    ];


    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, "cat_id");
    }
}
