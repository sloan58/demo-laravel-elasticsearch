<?php

use Illuminate\Support\Facades\Route;

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
use App\Models\Posts\PostsRepository;
use App\Models\Articles\ArticlesRepository;

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', function (ArticlesRepository $articlesRepository, PostsRepository $postsRepository) {

    $articles = $articlesRepository->search((string) request('q'));
    $posts = $postsRepository->search((string) request('q'));

    $results = $articles->concat($posts);

    return view('articles.index', [
        'results' => $results->shuffle(),
    ]);
});
