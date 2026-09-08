<?php

namespace Tests\Feature;

use App\Mail\BirthdayMessageReceived;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_a_birthday_message_is_saved_and_emailed_to_ralf(): void
    {
        $this->withoutMiddleware();
        Mail::fake();

        $response = $this->postJson('/birthday-messages', [
            'sender_name' => 'Maya',
            'message' => 'Happy birthday, Ralf!',
        ]);

        $response->assertOk()->assertJson(['message' => 'Your message is on its way to Ralf. Thank you!']);
        $this->assertDatabaseHas('birthday_messages', ['sender_name' => 'Maya', 'message' => 'Happy birthday, Ralf!']);
        Mail::assertSent(BirthdayMessageReceived::class, function (BirthdayMessageReceived $mail) {
            return $mail->hasTo('ralfanthonijsz@gmail.com');
        });
    }
}
