<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\RecipeIngredient;

class Blog extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $casts = [
        'id' => 'integer'
    ];

    public function RecipeIngredient()
    {
        return $this->hasMany(RecipeIngredient::class, "blog_id", "id");
    }
}