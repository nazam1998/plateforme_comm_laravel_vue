<?php

namespace App\Console\Commands;

use App\Mail\OpenTaskNotification;
use App\Models\Entreprise;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use  App\Jobs\OpenTaskJob;

class sendDailyTask extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daily:task';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send every task to do after 9pm';

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
        $entreprises = Entreprise::all();
        foreach ($entreprises as $entreprise) {
            $nom = $entreprise->nom;
            $email = $entreprise->email_contact;
            $taches = $entreprise->taches()->where('statut_id', 1)->get();
            $data = [
                'nom' => $nom,
                'email' => $email,
                'taches' => $taches
            ];
            if ($taches->count() > 0) {
                OpenTaskJob::dispatch($data);
            }
            $this->info('Daily report has been sent successfully');
        }
        if( count(Mail::failures()) > 0 ) {
        var_dump('failed');
        }
    }
}
