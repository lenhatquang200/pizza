<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Blog extends Model
{
    use CrudTrait;
    use HasFactory;

    // Add new fields to $fillable
    protected $fillable = ['title', 'content', 'slug', 'image', 'short_description'];

    protected static function boot()
    {
        parent::boot();

        // Automatically generate slug when creating or updating a blog
        static::creating(function ($blog) {
            $blog->slug = Str::slug($blog->title);
        });

        static::updating(function ($blog) {
            $blog->slug = Str::slug($blog->title);
        });

        static::deleting(function ($blog) {
            if (Storage::disk('public')->exists($blog->image)) {
                Storage::disk('public')->delete($blog->image);
            }
        });
    }
}
