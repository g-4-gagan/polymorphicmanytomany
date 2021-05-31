<?php

use Illuminate\Support\Facades\Route;
use App\Models\Post;
use App\Models\Video;
use App\Models\Tag;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/create',function(){

	$post = Post::create(['name'=>'Post 1']);
	$tag1 = Tag::findOrFail(1);
	$post->tags()->save($tag1);

	$video = Video::create(['name'=>'video.mov']);
	$tag2 = Tag::findOrFail(2);
	$video->tags()->save($tag2);

	return 'Done';

});

Route::get('/post{id}/tags',function($id){
	$post = Post::findOrFail($id);

	foreach ($post->tags as $tag) {
		echo $tag->name;
	}
});

Route::get('/post{id}/update',function($id){
	$post = Post::findOrFail($id);

	$post->tags()->whereName('Hello')->update(['name'=>'Php']);

	// foreach ($post->tags as $tag) {
	// 	return $tag->whereName('Hello')->update(['name'=>'Php']);
	// }
});

Route::get('/post{id}/delete',function($id){
	$post = Post::findOrFail($id);

	// $post->tags()->whereId(1)->delete();
	$post->tags()->detach([1]);

});


