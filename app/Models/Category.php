<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\hasMany;

class Category extends Model
{
    use HasFactory;

    protected $table = "categories";

    protected $fillable = [
        "category_name", "category_slug"
    ];



    public function subCategory(): hasMany
    {
        return $this->hasMany(sub_category::class, "cat_id");
    }
}
