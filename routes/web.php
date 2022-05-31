<?php

use System\Router\Web\Route;

Route::get('/', 'HomeController@index', 'home.index');
Route::get('/home', 'HomeController@index', 'home.home');
Route::get('/about', 'HomeController@about', 'home.about');
Route::get('/ads', 'HomeController@allAds', 'home.all.ads');
Route::get('/blog', 'HomeController@allblog', 'home.all.blog');
Route::get('/category/{id}','HomeController@category','home.category');
Route::get('/ads/{id}', 'HomeController@ads', 'home.ads');
Route::get('/logout','HomeController@logout','home.logout');
Route::get('/blog/{id}','HomeController@blog','home.blog');
Route::get('/search','HomeController@search','home.search');
Route::post('/comment/{post_id}','HomeController@comment','home.comment');
Route::get('/ajax','HomeController@postAjax','home.ajax');
// Route::get('/search', 'HomeController@search', 'home.search');
//ajax
// Route::get('/ajax-last-posts', 'HomeController@ajaxLastPosts', 'home.last.posts');




// Auth panel admin Routing
Route::get('/admin','Admin\AdminController@index','admin.index');




// category Route Routing
Route::get('/admin/category','Admin\CategoryController@index','admin.category.index');
Route::get('/admin/category/create','Admin\CategoryController@create','admin.category.create');
Route::post('/admin/category/store','Admin\CategoryController@store','admin.category.store');
Route::get('/admin/category/edit/{id}','Admin\CategoryController@edit','admin.category.edit');
Route::put('/admin/category/update/{id}','Admin\CategoryController@update','admin.category.update');
Route::delete('/admin/category/delete/{id}','Admin\categoryController@delete','admin.category.delete');


//post panel admin Routing
Route::get('/admin/post','Admin\PostController@index','admin.post.index');
Route::get('/admin/post/create','Admin\PostController@create','admin.post.create');
Route::post('/admin/post/store','Admin\PostController@store','admin.post.store');
Route::get('/admin/post/edit/{id}','Admin\PostController@edit','admin.post.edit');
Route::put('/admin/post/update/{id}','Admin\PostController@update','admin.post.update');
Route::delete('/admin/post/delete/{id}','Admin\PostController@delete','admin.post.delete');


// ads && Gallery panel admin Routing
Route::get('/admin/ads','Admin\AdsController@index','admin.ads.index');
Route::get('/admin/ads/create','Admin\AdsController@create','admin.ads.create');
Route::post('/admin/ads/store','Admin\AdsController@store','admin.ads.store');
Route::get('/admin/ads/edit/{id}','Admin\AdsController@edit','admin.ads.edit');
Route::put('/admin/ads/update/{id}','Admin\AdsController@update','admin.ads.update');
Route::delete('/admin/ads/delete/{id}','Admin\AdsController@delete','admin.ads.delete');
Route::get('/admin/ads/gallery/{id}','Admin\AdsController@gallery','admin.ads.gallery');
Route::post('/admin/ads/store-gallery-image/{id}','Admin\AdsController@storeGalleryImage','admin.ads.store.gallery.image');
Route::get('/admin/ads/delete-gallery-image/{gallery_id}','Admin\AdsController@deleteGalleryImage','admin.ads.delete.gallery.image');



// slider panel admin Routing
Route::get('/admin/slider','Admin\SlideController@index','admin.slider.index');
Route::get('/admin/slider/create','Admin\SlideController@create','admin.slider.create');
Route::post('/admin/slider/store','Admin\SlideController@store','admin.slider.store');
Route::get('/admin/slider/edit/{id}','Admin\SlideController@edit','admin.slider.edit');
Route::put('/admin/slider/update/{id}','Admin\SlideController@update','admin.slider.update');
Route::delete('/admin/slider/delete/{id}','Admin\SlideController@delete','admin.slider.delete');





// coment panel admin Routing
Route::get('/admin/coment','Admin\ComentController@index','admin.coment.index');
Route::get('/admin/coment/show/{$id}','Admin\ComentController@show','admin.coment.show');
Route::get('/admin/coment/approved/{$id}','Admin\ComentController@approved','admin.coment.approved');
Route::post('/admin/coment/ansverd/{$id}','Admin\ComentController@ansverd','admin.coment.ansverd');




// user panel admin Routing
Route::get('/admin/user','Admin\UserController@index','admin.user.index');
Route::get('/admin/user/edit/{id}','Admin\UserController@edit','admin.user.edit');
Route::get('/admin/user/approved/{id}','Admin\UserController@approved','admin.user.approved');
Route::put('/admin/user/update/{id}','Admin\UserController@update','admin.user.update');



//Auth Routing
Route::get('/register','Auth\RegisterController@view','auth.register.view');
Route::post('/auth/register','Auth\RegisterController@register','auth.register');
Route::get('/activation/{token}','Auth\RegisterController@activation','auth.register.activation');
Route::get('/auth/login','Auth\LoginController@view','auth.login.view');
Route::post('/auth/login','Auth\LoginController@login','auth.login');
Route::get('/forgot','Auth\ForgotController@view','auth.forgot');
Route::post('/forgot','Auth\ForgotController@forgot','auth.forgot');
Route::get('/reset/{token}','Auth\ResetController@view','auth.reset');
Route::put('/reset/change-password/{token}','Auth\ResetController@Change','auth.change');
Route::get('/logout','Auth\LogoutController@logout','logout');
