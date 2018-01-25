<?php

use App\User;
use App\Address;
use App\Post;
use App\Role;
use App\Staff;
use App\Photo;
use App\Product;

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
    
    $user = User::findOrFail(2);

    $role = new Role(['name'=>'Admin']);

    $user->roles()->save($role);

});

Route::get('/insert/polymorph', function () {

    $staff = Staff::findOrFail(1);

    $photo = new Photo(['path'=>'image.png']);

    $staff->photos()->save($photo);
    
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

Route::get('/update/manytomany', function () {

    $user = User::findOrFail(3);

    if($user->has('roles'))
    {
        foreach ($user->roles as $role) 
        {
            if(strtolower($role->name) == 'biasa aja')
            {
                $role->update(['name'=>'Orang Biasa']);
            }
        }
    }
    
});

Route::get('/update/polymorph', function () {
    
    $staff = Staff::findOrFail(1);

    if($staff->has('photos'))
    {
        foreach ($staff->photos as $photo) {
            $photo->update(['path'=>'baru.jpg']);
        }
    }

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

Route::get('/read/polymorph', function () {

    $staff = Staff::findOrFail(1);

    foreach ($staff->photos as $photo) {
        echo $photo->path;
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

Route::get('/delete/manytomany', function () {
    
    $user = User::findOrFail(2);

    $user->roles()->detach();

    $user->delete();

});

Route::get('/delete/polymorph', function () {
    
    $staff = Staff::findOrFail(1);

    $staff->photos()->whereId(1)->first()->delete();


});

//ATTACH

Route::get('/insert/manytomany/attach', function () {

    $user = User::findOrFail(2);

    $user->roles()->attach(4);
    
});

//DETACH

Route::get('/delete/manytomany/detach', function () {

    $user = User::findOrFail(2);

    $user->roles()->detach(4); //spesific role

    $user->roles()->detach(4); //all roles in id 2
    
});

//SYNC

Route::get('/update/manytomany/sync', function () {

    $user = User::findOrFail(5);

    $user->roles()->sync([4]);
    
});

//ASSIGN awalnya kosong jadi ada imagaable id

Route::get('/assign/polymorph', function () {
    
    $staff = Staff::findOrFail(1);

    $photo = Photo::findOrFail(4);

    $staff->photos()->save($photo);

});

//UNASSIGN

Route::get('/unassign/polymorph', function () {
    
    $staff = Staff::findOrFail(1);

    $photo = Photo::findOrFail(4);

    $staff->photos()->whereId(4)->update(['imageable_id'=>'','imageable_type'=>'']);

});