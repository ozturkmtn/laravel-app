<?php

namespace App\Jobs;

use App\Models\Company;
use App\Models\CompanyPackages;
use App\Models\CompanyPayments;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Nette\Utils\Random;

class PackagePaymentJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $companyPackageId;

    public function __construct($companyPackageId)
    {
        $this->companyPackageId = $companyPackageId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //$companyPackage = DB::table('company_packages')->find($this->companyPackageId);
        $companyPackage = CompanyPackages::find($this->companyPackageId);


        $hash = Random::generate(5, '0-9');
        $isPaid = ($hash % 2 == 0) ? 0 : 1;

        if ($isPaid == 1) {
            $package = DB::table('packages')->find($companyPackage->packages);
            $startDate = new \DateTime();
            $endDate = new \DateTime();
            $dateInterval = ($package->type == 'monthly') ? "+1 month" : "+1 year";
            $endDate = $endDate->modify($dateInterval);
            $companyPackage->start_date = $startDate;
            $companyPackage->end_date = $endDate;
            $companyPackage->status = 1;
            $companyPackage->payment_try = 0;
        } else {
            $companyPackage->status = 0;
            $companyPackage->payment_try = $companyPackage->payment_try + 1;

            if ($companyPackage->payment_try == 3) {
                $company = Company::find($companyPackage->company);
                $company->status = 0;
                $company->save();
            } else {
                \App\Jobs\PackagePaymentJob::dispatch($companyPackage->id)->delay(now()->addDay(1));
            }
        }

        $companyPackage->save();

        $companyPayment = new CompanyPayments();
        $companyPayment->company_packages = $companyPackage->id;
        $companyPayment->hash = $hash;
        $companyPayment->is_paid = $isPaid;

        $companyPayment->save();

    }
}
