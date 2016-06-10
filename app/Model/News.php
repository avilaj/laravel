<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class News extends Model implements SluggableInterface
{
    use SluggableTrait;
    protected $sluggable = [
        'build_from' => 'title',
        'save_to'    => 'slug',
    ];
    protected $table = 'news';
    protected $fillable = ['title','slug','pin', 'thumbnail', 'text', 'short_text', 'gallery_id'];

    public function gallery() {
    	return $this->belongsTo('App\Model\Gallery');
    }

    public function getThumbnailImageAttribute() {
        $image = empty($this->attributes['thumbnail']) ? '' : $this->attributes['thumbnail'];
        return str_replace('uploads/', '', $image);
    }
    public function getDateAttribute() {
        setlocale(LC_TIME, 'es_ES.utf8');
        return $this->created_at->formatLocalized('%B %d, %Y');
    }
    public function getUrlAttribute() {
    	$slug = str_slug($this->title);
    	return "/news/{$this->slug}";
    }
}
