<?php

namespace App\Models;
use Illuminate\Support\Facades\File;

use Illuminate\Database\Eloquent\ModelNotFoundException;

class Post {

    public $title;

    public $excerpt; 

    public $date ;

    public $body;

    public function __construct($title,$excerpt,$date,$body)
    {
        $this->title = $title;

        $this->excerpt = $excerpt;
        $this->date = $date;
        $this->body = $body;
        
    }
    public static function all()
    {
         $file = File::files(resource_path('posts/'));

        return  array_map(fn($file) =>  $file ->getContents(),$file); 
    }
 
    public static function find($slug) {
        $path = resource_path("posts/{$slug}.html");

        if (!file_exists($path)) {
            throw new ModelNotFoundException();
        }

        return cache()->remember("posts.{$slug}", 1200, fn() => file_get_contents($path));
    }
}
