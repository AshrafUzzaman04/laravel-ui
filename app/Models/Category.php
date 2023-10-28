<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
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

    //__mutators__//

    // public function setCategoryNameAttribute($value)
    // {
    //     $this->attributes["category_name"] = ucfirst($value);
    // }


    //__OR__//

    protected function categoryName(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => ucfirst($value),
        );
    }

    public function subCategory(): hasMany
    {
        return $this->hasMany(sub_category::class, "cat_id");
    }
}
