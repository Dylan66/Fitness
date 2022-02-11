<?php


use App\User;
use App\Booking;
use App\Payment;
use App\Notifications\Approved;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Notification;
use App\Notifications\Payment as NotificationsPayment;

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/approve/{id}', 'UsersController@save');
Route::get('/approve/{id}', 'UsersController@approve');
Route::get('/data/{id}', 'UsersController@data_page');
Route::post('/data/{id}', 'UsersController@data');
Route::get('/pending', 'UsersController@pending');
Route::resource('/users', 'UsersController');
Route::resource('/trainers', 'TrainersController');
Route::resource('/bookings', 'BookingsController');
Route::resource('/payments', 'PaymentsController');
Route::resource('/posts', 'PostsController');
Route::resource('/services', 'ServicesController');

Route::get('/paypal/{booking}', 'PaymentsController@paypal_payment')->name('paypal');
Route::get('/success', 'PaymentsController@paypal_success')->name('success');

Route::get('/', 'PagesController@index')->name('index');
Route::get('/ourtrainers', 'PagesController@trainers');
Route::get('/ourservices', 'PagesController@services');
Route::get('/ourtrainers/{trainer}', 'PagesController@trainer');
Route::get('/ourservices/{service}', 'PagesController@service');

Route::post('/booking/search', 'BookingsController@search')->name('booking.search');
Route::get('/getservices', 'ServicesController@services');


// Dedicated pages

// users
Route::prefix('/user')->group(function () {
    Route::get('/', 'UserCont@index')->name('user.index');
    Route::get('/wait', 'HomeController@wait')->name('user.wait');
    Route::get('/payments', 'UserCont@payments')->name('user.payments');
    Route::get('/payments/{payment}', 'UserCont@payment')->name('user.payment');
    Route::get('/bookings', 'UserCont@bookings')->name('user.bookings');
    Route::get('/bookings/{booking}', 'UserCont@booking')->name('user.booking');
    Route::get('/pending', 'UserCont@pending')->name('user.pending');
    Route::get('/future', 'UserCont@future')->name('user.future');
});

// trainers
Route::prefix('/trainer')->group(function () {
    Route::get('/', 'TrainerCont@index')->name('trainer.index');
    Route::get('/finish', 'TrainerCont@finish')->name('trainer.finish');
    Route::post('/finish', 'TrainerCont@save')->name('trainer.save');
    Route::get('/bookings', 'TrainerCont@bookings')->name('trainer.bookings');
    Route::get('/bookings/{booking}', 'TrainerCont@booking')->name('trainer.booking');
    Route::get('/future', 'TrainerCont@future')->name('trainer.future');
});

Route::get('/send', function () {
    //
    $user = User::find(1);
    Notification::send($user, new Approved());
});

Route::get('/payy', function () {
    //
    $user = User::find(1);
    $payment = Payment::find(1);
    // return $payment;
    $booking = Booking::find(1);
    // return $booking;


    Notification::send(Auth::user(), new NotificationsPayment($booking, $payment));
});
