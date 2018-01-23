<?php

use App\User;
use App\Address;
use App\Post;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

//CRUD

//INSERT
Route::get('/insert/onetoone', function () {

    $user = User::findOrFail(1);

    $address = new Address(['name'=>'coba ae wes']);
    // $address::create(['name'=>'coba ae wes']);

    $user->addresses()->save($address);

});

Route::get('/insert/onetomany', function () {
    
    $user = User::findOrFail(2);

    // $post = new Post(['title'=>'title gan','body'=>'body gan']);

    // $user->posts()->save($post);

    $user->posts()->create(['title'=>'coba title baru','body'=>'just say good bye']);

});


//UPDATE
Route::get('/update/onetoone', function () {

    $address = Address::where('user_id',1)->get();

    // $address->name = 'Lol' ;

    foreach ($address as $test) {
        $test-> name = 'haha';
        $test->save();
    }    

    // $address->save();

});

//READ
Route::get('/read/onetoone', function () {
    
    $reads = User::find(1)->addresses()->get();

    foreach ($reads as $read) {
        echo $read;
    }

});

Route::get('/read/onetomany', function () {

    $posts = Post::findOrFail(2)->users()->get();

    // return $posts;

    dd($posts);
    
});

//DELETE
Route::get('/delete/onetoone', function () {
    
    $delete = User::findOrFail(1);

    $delete->addresses()->delete();
    $delete->delete();

});