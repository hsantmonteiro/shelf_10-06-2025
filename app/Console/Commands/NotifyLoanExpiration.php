<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Loan;
use App\Models\User;
use App\Support\DripEmailer;
use App\Mail\LoanReminderMail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;


class NotifyLoanExpiration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'loans:notify-expiring';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envia um aviso a usuários com empréstimos próximos ao fim';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $targetDate = Carbon::now()->addDays(2)->startOfDay();
        $loans = Loan::whereDate('dt_devolucao', $targetDate)
            ->where('fl_devolvido', false)
            ->with('usuario')
            ->get();

        foreach ($loans as $loan) {
            Mail::to($loan->usuario->email)->send(new LoanReminderMail($loan));
        }

        $this->info('Notificações de empréstimo enviadas.');
    }
}
