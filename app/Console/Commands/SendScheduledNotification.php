<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Notifications\FcmNotification;
use Illuminate\Console\Command;

class SendScheduledNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notif:send';

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
        $users = User::whereNotNull('fcm_token')->get();

        foreach ($users as $user) {
            $user->notify(new FcmNotification(
                title: "Jadwal Notifikasi",
                body: "Notifikasi dari Laravel Schedule"
            ));
        }

        $this->info("Notifikasi terkirim ke {$users->count()} user.");
    }
}
