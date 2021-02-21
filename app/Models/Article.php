<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    
    public function tags()
    {
    	return $this->belongsToMany(Tag::class, 'article_to_tags', 'article_id', 'tag_id');
    }
    
    /**
	 * Return array of tag links
	 *
	 * @param string $base
	 * @return array
	 */
	public function tagLinks($base = '/article-post?tag=%TAG%')
	{
	    $tags = $this->tags()->get()->pluck('name')->all();
	    $return = [];
	    foreach ($tags as $tag) {
	        $url = str_replace('%TAG%', urlencode($tag), $base);
	        $return[] = '<a href="' . $url . '">' . e($tag) . '</a>';
	    }
	    return $return;
	}
}
