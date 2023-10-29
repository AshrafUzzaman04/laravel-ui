<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        "cat_id", "subcat_id", "user_id", "title", "slug", "description", "post_image"
    ];

    protected $casts = [
        "title" => "string", "slug" => "string", "status" => "integer"
    ];

    //__foreign key constains__//
    public function userName(): BelongsTo
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function categoryname(): BelongsTo
    {
        return $this->belongsTo(Category::class, "cat_id");
    }

    public function subCategoryName(): BelongsTo
    {
        return $this->belongsTo(sub_category::class, "subcat_id");
    }
}
