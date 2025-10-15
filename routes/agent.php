<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Agent\ServiceBookingController;
use App\Http\Controllers\ServicePaymentController;
use App\Http\Controllers\Agent\NewsController as AgentNewsController;
use App\Http\Controllers\Admin\CertificateController;
use App\Http\Controllers\Agent\TicketController;
/*
|--------------------------------------------------------------------------
| Agent Routes
|--------------------------------------------------------------------------
*/

Route::prefix('agent')->name('agent.')->middleware(['auth','role:agent'])->group(function () {
    Route::get('/home', [App\Http\Controllers\Agent\HomeController::class, 'index'])->name('dashboard');
    
    // Services
    Route::get('services', [ServiceBookingController::class, 'serviceList'])->name('services.index');
    Route::get('services/{id}', [ServiceBookingController::class, 'serviceDetails'])->name('services.show');

    // Bookings
    Route::get('bookings', [ServiceBookingController::class, 'index'])->name('bookings.index');
    Route::get('bookings/new', [ServiceBookingController::class, 'create'])->name('bookings.create');
    Route::post('bookings', [ServiceBookingController::class, 'store'])->name('bookings.store');
    Route::get('bookings/{id}', [ServiceBookingController::class, 'bookedServiceShow'])->name('bookings.show');

    // Booking client form
    Route::get('services/book/{id}', [ServiceBookingController::class, 'showClientForm'])->name('bookings.clientForm');
    Route::post('services/book/{id}', [ServiceBookingController::class, 'createBooking'])->name('bookings.createBooking');

    // Document uploads
    Route::get('bookings/{booking}/upload', [ServiceBookingController::class, 'uploadDocument'])->name('bookings.uploadDocument');
    Route::get('bookings/{booking}/upload/{document}', [ServiceBookingController::class, 'showUploadForm'])->name('bookings.showUploadForm');
    Route::post('bookings/{booking}/upload', [ServiceBookingController::class, 'storeDocument'])->name('bookings.storeDocument');
    Route::delete('bookings/{booking}/document/{document}', [ServiceBookingController::class, 'destroyDocument'])->name('bookings.destroyDocument');

    // Payments
     Route::get('bookings/{order}/payments', [ServicePaymentController::class, 'index'])->name('payments.index');
     Route::post('bookings/{order}/payments', [ServicePaymentController::class, 'store'])->name('payments.store');
     Route::get('invoices/{bookingId}/download', [App\Http\Controllers\InvoiceController::class, 'downloadFinalInvoice'])->name('invoices.download');

     //Route::get('agent/faqs', [\App\Http\Controllers\Agent\FaqController::class, 'index'])->name('agent.faqs.index');

     Route::get('/faqs', [\App\Http\Controllers\Agent\FaqController::class, 'index'])->name('faqs.index');

        Route::get('/blogs', [\App\Http\Controllers\Agent\BlogController::class, 'index'])->name('blogs.index');
        Route::get('/blogs/{id}', [\App\Http\Controllers\Agent\BlogController::class, 'show'])->name('blogs.show');

        Route::get('news', [AgentNewsController::class, 'index'])->name('news.index');
        Route::get('news/{news}', [AgentNewsController::class, 'show'])->name('agent.news.show');

        Route::get('/certificates/download/{id}', [CertificateController::class, 'download'])->name('certificates.download');
        // Tickets
        Route::get('tickets', [TicketController::class,'index'])->name('tickets.index');
        Route::get('tickets/create', [TicketController::class,'create'])->name('tickets.create');
        Route::post('tickets', [TicketController::class,'store'])->name('tickets.store');
        Route::get('agent/tickets/{ticket}', [TicketController::class,'show'])->name('tickets.show');
        Route::post('tickets/{ticket}/reply', [TicketController::class,'reply'])->name('tickets.reply');
});
