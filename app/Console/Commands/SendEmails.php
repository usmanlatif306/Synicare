<?php

namespace App\Console\Commands;

use App\Models\Appointment;
use App\Models\User;
use App\Notifications\ReminderNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;
use App\Notifications\TestEmailNotification;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emails:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sending reminder emails';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $appointments = Appointment::where('is_reminded', false)->where('due', '<=', now()->addHours(1))->get();

        foreach ($appointments  as  $appointment) {
            $appointment->user->notify(new ReminderNotification($appointment));
            $appointment->update(['is_reminded' => true]);
        }

        $this->info('Emails send successfully.');
    }
}
