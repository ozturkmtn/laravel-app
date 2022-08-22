<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CompanyController extends Controller
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
            $company = new Company();
            $company->site_url = $request->site_url;
            $company->name = $request->name;
            $company->lastname = $request->lastname;
            $company->company_name = $request->company_name;
            $company->email = $request->email;
            $company->password = Hash::make($request->password);
            $company->token = Str::random(60);
            $company->status = 1;

            $company->save();
        } catch (\Exception $e) {
            return response()->json(["status" => $e->getCode(), "message" => $e->getMessage()]);
        }

        return response()->json(["status" => 200, "company_id" => $company->id, "token" => $company->token]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $company = DB::table('companies')->where('token', '=', $id)->first();
            $package = DB::table('packages')->where('id', '=', $company->packages)->first();
        } catch (\Exception $e) {
            return response()->json(['status' => $e->getCode(), 'message' => $e->getMessage()]);
        }

        return response()->json(['status' => 200, 'company' => $company, 'packages' => $package]);
    }

}
