<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanyPackages;
use App\Models\Packages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompanyPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $company = DB::table('companies')->find($request->company_id);
//            $company = Company::findOrFail($request->company_id);
//            $package = Packages::findOrFail($request->package_id);
            $package = DB::table('packages')->find($request->package_id);
            $startDate = new \DateTime();
            $endDate = new \DateTime();
            $dateInterval = ($package->type == 'monthly') ? "+1 month" : "+1 year";
            $endDate = $endDate->modify($dateInterval);

            $companyPackage = new CompanyPackages();
            $companyPackage->company = $request->company_id;
            $companyPackage->packages = $request->package_id;
            $companyPackage->start_date = $startDate;
            $companyPackage->end_date = $endDate;
            $companyPackage->status = 0;
            $companyPackage->payment_try = 0;
            $companyPackage->save();

            $company->packages = $request->package_id;
//            $company->save();

        } catch (\Exception $e) {
            return response()->json(['status' => $e->getCode(), 'message' => $e->getMessage()]);
        }

        return response()->json([
            'status' => 200,
            'start_date' => $companyPackage->start_date->format('d-m-Y'),
            'end_date' => $companyPackage->end_date->format('d-m-Y'),
            'package' => $package,
        ]);
    }

}
