<?php
Route::redirect('/','inicio');

Auth::routes();

Route::get('inicio', 'Web\PageController@index')->name('home');

Route::post('registro', 'Web\RegisterController@index')->name('register_user');

Route::get('get_post', 'Web\PageController@get_post')->name('get_post');

Route::get('articulo/{slug}', 'Web\PageController@post')->name('post');

Route::get('categoria/{slug}', 'Web\PageController@category')->name('category');

Route::get('etiqueta/{slug}', 'Web\PageController@tag')->name('tag');

Route::get('articulos', 'Web\PageController@posts')->name('g_posts');

Route::post('password_recupery','Web\RegisterController@restore')->name('password_recupery');

Route::post('password_confirm_data','Web\RegisterController@password_confirm_data')->name('password_confirm_data');

Route::get('perfil/{id}','Web\PageController@profile')->name('profile_web');

Route::get('editar-perfil/{id}','Web\PageController@editProfile')->name('edit_profile');

Route::put('update_profile/{id}','Web\PageController@updateProfile')->name('update_profile');

Route::get('noticia/{slug}', 'Web\PageController@notice')->name('notice');

Route::get('noticia-categoria/{slug}', 'Web\PageController@categoryNotice')->name('category_notices');

Route::get('noticia-etiqueta/{slug}', 'Web\PageController@tagNotice')->name('tag_notices');

Route::get('noticias', 'Web\PageController@list_notices')->name('n_notices');



Route::group(['middleware' => 'auth'], function () {
    Route::get('publicaciones', 'Web\PageController@panel')->name('panel');
    Route::get('nueva-publicacion', 'Web\PageController@newPost')->name('new_post');
    Route::post('nueva-publicacion', 'Web\PageController@storePost')->name('store_post');
    Route::get('editar-publicacion/{id}', 'Web\PageController@editPost')->name('edit_post');
    Route::put('update-publicacion/{id}', 'Web\PageController@updatePost')->name('update_post');
    Route::delete('eliminar-publicacion/{id}', 'Web\PageController@deletePost')->name('delete_post');
    Route::get('mis-noticias', 'Web\PageController@notices')->name('notices');
    Route::get('nuevo-publicista', 'Web\PageController@newPublicist')->name('new_publicist');
    Route::post('nuevo-publicista', 'Web\PageController@storePublicist')->name('store_publicist');
    Route::get('nueva-noticia', 'Web\PageController@newNotice')->name('new_notice');
    Route::post('nueva-noticia', 'Web\PageController@storeNotice')->name('store_notice');
    Route::get('editar-noticia/{id}', 'Web\PageController@editNotice')->name('edit_notice');
    Route::put('update-noticia/{id}', 'Web\PageController@updateNotice')->name('update_notice');
    Route::delete('eliminar-noticia/{id}', 'Web\PageController@deleteNotice')->name('delete_notice');
    Route::get('editar-perfil/{id}','Web\PageController@editProfile')->name('edit_profile');
    Route::put('update_profile/{id}','Web\PageController@updateProfile')->name('update_profile');
});


Route::group(['prefix'=>'admin','middleware'=>'admin', 'namespace' => 'Admin'], function (){
	Route::get('inicio','AdminController@index')->name('admin_index');
	Route::resource('categories','CategoryController');
	Route::resource('tags','TagController');
	Route::resource('users','UserController');
	Route::resource('posts','PostController');
    Route::resource('publicists','PublicistController');
    Route::resource('notices','NoticeController');
});

//Mails
Route::get('register_confirmed/{id}','Web\RegisterController@registerConfirmed')->name('register_confirmed');
Route::get('pass_reset_data/{pass}','Web\RegisterController@reset_data')->name('reset_data');

