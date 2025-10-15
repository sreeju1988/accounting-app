<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;

use Illuminate\Support\Facades\Mail;

use App\Http\Controllers\Admin\TicketController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function(){
    return redirect('/login');
});
Route::get('/testmail', function () {
   
    $recipientEmail = 'sreejith.ms2@gmail.com';
    $subject = 'Test Email from Laravel (no view)';
    $body = 'This is a test email sent directly from web.php without a Blade view.';

    Mail::raw($body, function ($message) use ($recipientEmail, $subject) {
        $message->to($recipientEmail)
                ->subject($subject);
    });

    return "Test email sent successfully!";

});

Auth::routes(['register' => false]);

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/change-password', [ProfileController::class, 'showChangePasswordForm'])->name('profile.password.edit');
    Route::post('/profile/change-password', [ProfileController::class, 'changePassword'])->name('profile.password.update');
});



Route::prefix('admin')->middleware(['auth','role:super_admin,staff'])->group(function () {
    Route::get('tickets', [TicketController::class,'index'])->name('tickets.index');
    Route::get('tickets/{ticket}', [TicketController::class,'show'])->name('tickets.show');
    Route::post('tickets/{ticket}/reply', [TicketController::class,'reply'])->name('tickets.reply');
    Route::post('tickets/{ticket}/assign', [TicketController::class,'assign'])->name('tickets.assign');
    Route::post('tickets/{ticket}/status', [TicketController::class,'changeStatus'])->name('tickets.status');
});