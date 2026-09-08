<?php

namespace App\Http\Controllers;

use App\Mail\BirthdayMessageReceived;
use App\Models\BirthdayMessage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class BirthdayMessageController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'sender_name' => ['required', 'string', 'max:80'],
            'message' => ['required', 'string', 'max:1000'],
        ]);

        $birthdayMessage = BirthdayMessage::create($validated);

        Mail::to('ralfanthonijsz@gmail.com')->send(new BirthdayMessageReceived($birthdayMessage));

        return response()->json(['message' => 'Deine Nachricht ist auf dem Weg zu Ralf. Danke!']);
    }
}
