<?php

use App\User;
use App\Address;
use App\Post;
use App\Role;

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

Route::get('/insert/manytomany', function () {
    
    $user = User::findOrFail(3);

    $role = new Role(['name'=>'Orang Biasa']);

    $user->roles()->save($role);

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

Route::get('/update/onetomany', function () {

    $user = User::find(2);
    // $posts = Post::findOrFail(1);

    // $posts->title = 'test wae wae';
    // $posts->body = 'let me do it';

    $user->posts()->where('user_id','2')->update(['title'=>'test gan','body'=>'body bae bae']);
    
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

Route::get('/read/manytomany', function () {
    
    // $roles = Role::find(1)->users;

    // echo ($roles);


    $users = User::find(3)->roles;

    foreach ($users as $user) {
        echo $user->name."<br>";
    }

});

//DELETE
Route::get('/delete/onetoone', function () {
    
    $delete = User::findOrFail(1);

    $delete->addresses()->delete();
    $delete->delete();

});

Route::get('/delete/onetomany', function () {
    
    $delete = User::findOrFail(2);

    $delete->posts;

    return $delete;

    $delete->posts()->where('id',3)->delete();

});