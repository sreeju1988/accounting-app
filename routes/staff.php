<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Staff\TicketController;
use App\Http\Controllers\Staff\ServiceBookingController;
use App\Http\Controllers\Staff\ServicePaymentController;
use App\Http\Controllers\InvoiceController;
use App\http\Controllers\Staff\CertificateController;


Route::prefix('staff')->name('staff.')->middleware(['auth','role:staff'])->group(function () {

    Route::get('/home', [App\Http\Controllers\Staff\HomeController::class, 'index'])->name('dashboard');

    //Support Tickets
    Route::get('tickets', [TicketController::class,'index'])->name('tickets.index');
    Route::get('tickets/{ticket}', [TicketController::class,'show'])->name('tickets.show');
    Route::post('tickets/{ticket}/reply', [TicketController::class,'reply'])->name('tickets.reply');
    Route::post('tickets/{ticket}/assign', [TicketController::class,'assign'])->name('tickets.assign');
    Route::post('tickets/{ticket}/status', [TicketController::class,'changeStatus'])->name('tickets.status');


    // View all agent bookings
    Route::get('/service_order/all', [ServiceBookingController::class, 'index'])->name('service_order.all');
    Route::get('/service_order/in-progress', [ServiceBookingController::class, 'inprogressBookings'])->name('service_order.inprogress');
    Route::get('/service_order/completed', [ServiceBookingController::class, 'completedBookings'])->name('service_order.completed');
    Route::get('/service_order/cancelled', [ServiceBookingController::class, 'cancelledBookings'])->name('service_order.cancelled');
    Route::get('/service_order/{id}', [ServiceBookingController::class, 'show'])->name('service_order.show');
    Route::post('/service_order/{id}/update-status', [ServiceBookingController::class, 'updateStatus'])->name('service_order.update_status');
    Route::get('/service_order/{id}/assign-staff', [ServiceBookingController::class, 'assignStaffForm'])->name('service_order.assign_staff_form');
    Route::post('/service_order/{id}/assign-staff', [ServiceBookingController::class, 'assignStaff'])->name('service_order.assign_staff');
    // Certificates
    Route::get('/certificates/{booking_id}/list', [CertificateController::class, 'index'])->name('certificates.index');
    Route::get('/certificates/upload/{serviceOrder}', [CertificateController::class, 'create'])->name('certificates.create');
    Route::post('/certificates/{serviceOrder}', [CertificateController::class, 'store'])->name('certificates.store');
    Route::get('/certificates/download/{id}', [CertificateController::class, 'download'])->name('certificates.download');
    // View payments for a specific order
    Route::get('orders/{order}/payments', [ServiceBookingController::class, 'adminIndex'])->name('payments.index');
    Route::get('/invoice/{id}/download', [InvoiceController::class, 'download'])->name('invoice.download');
    // Add service fees
    Route::get('/service_order/{id}/add-fees', [ServiceBookingController::class, 'addFeesForm'])->name('service_order.add_fees_form');
    Route::post('/service_order/{id}/add-fees', [ServiceBookingController::class, 'addFees'])->name('service_order.add_fees');
    // Add payment
    Route::get('/service_order/{id}/add-payment', [ServicePaymentController::class, 'addPaymentForm'])->name('service_order.add_payment_form');
    Route::post('/service_order/{id}/add-payment', [ServicePaymentController::class, 'storePayment'])->name('service_order.store_payment');
    // Download final invoice
    Route::get('/invoice/service/{bookingId}/download', [App\Http\Controllers\InvoiceController::class, 'downloadFinalInvoice'])
        ->name('final_invoice.service.download');
});