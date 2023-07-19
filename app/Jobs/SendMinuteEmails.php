<?php

namespace App\Jobs;

use App\Models\Event;
use App\Mail\SendMail;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SendMinuteEmails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // $users= Event::all();
        // foreach ($users as $user) {
        //     // Envoyer l'email à chaque utilisateur
        //    $mail= $user->user()->get()[0]->email;
        //     Mail::to($mail)->send(new SendMail());
        // }
        
        // $this->delay(1 * 60); // 1 minute
    }
}
