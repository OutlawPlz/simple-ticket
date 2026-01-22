<?php

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/tickets', fn (Request $request) => Ticket::query()->opened()->get());

Route::patch('/tickets/{ticket}', function (Request $request, Ticket $ticket) {
    $status = $request->validate(['status' => ['required', 'in:open,closed'],])['status'];

    match ($status) {
        'open' => $ticket->reopen(),
        'closed' => $ticket->close(),
    };
});
