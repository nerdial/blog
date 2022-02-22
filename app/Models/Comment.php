<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

use Kalnoy\Nestedset\NodeTrait;

class Comment extends Model
{
    use HasFactory;
    use NodeTrait;

    protected $fillable = [
        'post_id' , 'name' , 'body', 'parent_id'
    ];

    protected function CreatedAt(): Attribute
    {
        return new Attribute(
            get: fn ($value) => $value,
        );
    }


}
