<?php

namespace App\Console\Commands;

use App\Models\Event;

use App\Mail\SendMail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendEmailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'adja:sendemail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Mail::to('evasow2001@gmail.com')->send(new SendMail());
        $users= Event::all();

        foreach ($users as $user) {
            // Envoyer l'email à chaque utilisateur
            $mail= $user->user()->get()[0]->email;
            Mail::to($mail)->send(new SendMail());
        }
    }
}

