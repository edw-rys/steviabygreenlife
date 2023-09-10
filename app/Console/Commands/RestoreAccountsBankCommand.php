<?php

namespace App\Console\Commands;

use App\Models\AccountsBank;
use Illuminate\Console\Command;

class RestoreAccountsBankCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'restore-accounts:bank';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        AccountsBank::whereRaw('1=1')->delete();
        $items = [
            [
                'number_account'    => '00000000001',
                'bank_name'         => 'Banco Pichincha',
                'type_account'      => 'Cuenta Corriente'
            ],
            [
                'number_account'    => '00000000001',
                'bank_name'         => 'Banco de Guayaquil',
                'type_account'      => 'Cuenta de Ahorros'
            ],
        ];
        foreach ($items as $key => $item) {
            AccountsBank::create( [
                'number_account'    => $item['number_account'],
                'bank_name'         => $item['bank_name'],
                'type_account'      => $item['type_account']
            ]);
        }
        return 0;
    }
}
