<?php

namespace App\Console\Commands;

use App\Models\Company;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CheckPackages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:check-packages';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $now = new \DateTime();
        $companyPackages = DB::table('company_packages')->where('end_date', '<=', $now->format('Y-m-d'))->get();

        foreach ($companyPackages as $companyPackage) {
            $company = Company::find($companyPackage->company);

            if ($company->status != 0) {
                $this->info('$companyPackage! '. $companyPackage->id .'end_date '. $companyPackage->end_date .' = '. $now->format('Y-m-d'));
                \App\Jobs\PackagePaymentJob::dispatch($companyPackage->id);
            }
        }

        return 0;
    }
}

