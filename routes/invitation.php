<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\AgentInvitationController;

/*
|--------------------------------------------------------------------------
| Invitation Routes
|--------------------------------------------------------------------------
*/

Route::get('/invitations/accept/{token}', [InvitationController::class, 'accept'])->name('invitations.accept');
Route::post('/invitations/register/{token}', [InvitationController::class, 'register'])->name('invitations.register');

Route::get('/invitations/agent/accept/{token}', [AgentInvitationController::class, 'accept'])->name('invitations.agent.accept');
Route::post('/invitations/agent/register/{token}', [AgentInvitationController::class, 'register'])->name('invitations.agent.register');
