<?php

use Illuminate\Support\Facades\Route;
use App\Models\Post;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;
use Symfony\Component\Yaml\Yaml;

use function PHPUnit\Framework\fileExists;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $files = File::files(resource_path("posts"));
    $posts = [];

    foreach ($files as $file) {
        $document = YamlFrontMatter::parseFile($file);
        $posts[] = new Post(
            $document->title,
            $document->excerpt,
            $document->date,
            $document->body()
        );
    }
    //ddd($posts);
    return view('posts',[
        'post' =>$posts
    ]);
    
});


//Find post by its slug and pass it to view called "post"

Route::get('posts/{post}', function($slug){

    $post = Post::find($slug);

    return view('post', [
        'post' => $post
    ]); 

})->where('post', '[A-z\_-]+');













/* example
Route::get('posts/{post}', function ($slug) {
    $fileName = "{$slug}.html";
    $filePath = base_path("resources/posts/{$fileName}");
    
    
    if (file_exists($filePath)) {
        $post = file_get_contents($filePath);

        return view('post', [
            'post' => $post
        ]);
    } else {
        abort(404);
    }
});*/



