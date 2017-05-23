<?php

namespace Afrittella\BackProjectCategories\Domain\Models;

use Afrittella\BackProject\Traits\HasOneAttachment;
use Afrittella\BackProject\Traits\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;


class Category extends Model
{
    use HasOneAttachment, NodeTrait, Sluggable;

    protected $fillable = ['name', 'slug', 'description', 'parent_id'];

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = $this->createSlug($value, $this->id);
    }


}
