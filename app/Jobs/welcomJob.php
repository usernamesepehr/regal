<?php

namespace App\Jobs;

use App\Mail\welcomMail;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class welcomJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
       public User $user
    ){}

    public $maxExceptions = 3;
    public $timeout = 60;
    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->user->email)->send(new welcomMail($this->user->name));
    }
}
