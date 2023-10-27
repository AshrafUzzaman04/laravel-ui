<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sub_category extends Model
{
    use HasFactory;

    protected $table = "sub_categories";

    protected $fillable = [
        "cat_id", "sub_catname", "sub_catslug"
    ];
}
