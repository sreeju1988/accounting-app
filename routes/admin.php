<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\AgentInvitationController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\DocumentRuleController;
use App\Http\Controllers\Agent\ServiceBookingController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\ServiceBookingController as AdminServiceBookingController;
use App\Http\Controllers\Admin\ServicePaymentController;
use App\Http\Controllers\Admin\CertificateController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\Admin\TicketController;
/*
|--------------------------------------------------------------------------
| Admin Routes (Super Admin Panel)
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:super_admin'])->group(function () {

    Route::get('/home', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('dashboard');
    
    // Invitations
    Route::get('/invitations', [InvitationController::class, 'index'])->name('invitations.index');
    Route::get('/invitations/create', [InvitationController::class, 'create'])->name('invitations.create');
    Route::post('/invitations', [InvitationController::class, 'store'])->name('invitations.store');
    Route::get('/invitations/{id}/resend', [InvitationController::class, 'resend'])->name('invitations.resend');

    // Agent Invitations
    Route::get('/invitations/agent', [AgentInvitationController::class, 'index'])->name('invitations.agent.index');
    Route::get('/invitations/agent/create', [AgentInvitationController::class, 'create'])->name('invitations.agent.create');
    Route::post('/invitations/agent', [AgentInvitationController::class, 'store'])->name('invitations.agent.store');
    Route::get('/invitations/agent/{token}/resend', [AgentInvitationController::class, 'resend'])->name('invitations.agent.resend');

    // Staff & Agent Management
    Route::get('/staff', [StaffController::class, 'index'])->name('staff.index');
    Route::post('/staff/{user}/toggle', [StaffController::class, 'toggleStatus'])->name('staff.toggle');
    Route::get('/staff/{user}', [StaffController::class, 'show'])->name('staff.show');
    Route::get('/staff/completed/{user}', [StaffController::class, 'completedProjects'])->name('staff.completed_projects');



    Route::get('/agents', [AgentController::class, 'index'])->name('agents.index');
    Route::post('/agents/{user}/toggle', [AgentController::class, 'toggleStatus'])->name('agents.toggle');
    Route::get('/agents/{user}', [AgentController::class, 'show'])->name('agents.show');

    // Document Rules
    Route::resource('document-rules', DocumentRuleController::class);

    

    // Service Management
    Route::resource('services', ServiceController::class);

    // View all agent bookings
    Route::get('/service_order/all', [AdminServiceBookingController::class, 'index'])->name('service_order.all');
    Route::get('/service_order/in-progress', [AdminServiceBookingController::class, 'inprogressBookings'])->name('service_order.inprogress');
    Route::get('/service_order/completed', [AdminServiceBookingController::class, 'completedBookings'])->name('service_order.completed');
    Route::get('/service_order/cancelled', [AdminServiceBookingController::class, 'cancelledBookings'])->name('service_order.cancelled');
    Route::get('/service_order/{id}', [AdminServiceBookingController::class, 'show'])->name('service_order.show');
    Route::post('/service_order/{id}/update-status', [AdminServiceBookingController::class, 'updateStatus'])->name('service_order.update_status');
    Route::get('/service_order/{id}/assign-staff', [AdminServiceBookingController::class, 'assignStaffForm'])->name('service_order.assign_staff_form');
    Route::post('/service_order/{id}/assign-staff', [AdminServiceBookingController::class, 'assignStaff'])->name('service_order.assign_staff');

    // View payments for a specific order
    Route::get('orders/{order}/payments', [ServicePaymentController::class, 'adminIndex'])->name('payments.index');

    Route::get('/invoice/{id}/download', [InvoiceController::class, 'download'])->name('invoice.download');

    Route::get('/service_order/{id}/add-fees', [AdminServiceBookingController::class, 'addFeesForm'])->name('service_order.add_fees_form');
    Route::post('/service_order/{id}/add-fees', [AdminServiceBookingController::class, 'addFees'])->name('service_order.add_fees');

    Route::get('/service_order/{id}/add-payment', [ServicePaymentController::class, 'addPaymentForm'])->name('service_order.add_payment_form');
    Route::post('/service_order/{id}/add-payment', [ServicePaymentController::class, 'storePayment'])->name('service_order.store_payment');

        Route::get('/invoice/service/{bookingId}/download', [App\Http\Controllers\InvoiceController::class, 'downloadFinalInvoice'])
        ->name('final_invoice.service.download');

 

    //Certificate
    Route::get('/certificates/{booking_id}/list', [CertificateController::class, 'index'])->name('certificates.index');
    Route::get('/certificates/upload/{serviceOrder}', [CertificateController::class, 'create'])->name('certificates.create');
    Route::post('/certificates/{serviceOrder}', [CertificateController::class, 'store'])->name('certificates.store');
    Route::get('/certificates/download/{id}', [CertificateController::class, 'download'])->name('certificates.download');

    Route::resource('faqs', \App\Http\Controllers\Admin\FaqController::class);
    Route::resource('blogs', \App\Http\Controllers\Admin\BlogController::class);
    Route::resource('news', \App\Http\Controllers\Admin\NewsController::class);

    Route::get('tickets', [TicketController::class,'index'])->name('tickets.index');
    Route::get('tickets/{ticket}', [TicketController::class,'show'])->name('tickets.show');
    Route::post('tickets/{ticket}/reply', [TicketController::class,'reply'])->name('tickets.reply');
    Route::post('tickets/{ticket}/assign', [TicketController::class,'assign'])->name('tickets.assign');
    Route::post('tickets/{ticket}/status', [TicketController::class,'changeStatus'])->name('tickets.status');

});
// Document Download for both Super Admin and Agent
Route::middleware(['auth', 'role:super_admin|agent'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/download_document/{documentId}', [AdminServiceBookingController::class, 'downloadDocument'])->name('document.download');
    
});


