<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Http\Requests\ContactRequest;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the companies.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::all();

        return CompanyResource::collection($companies);
    }

    /**
     * Store a newly created company in storage.
     *
     * @param  \App\Http\Requests\CompanyRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyRequest $request)
    {
        $data = $request->all();

        $newCompany = new Company($data);
        $newCompany->save();

        return new CompanyResource($newCompany);
    }

    /**
     * Display the specified company.
     *
     * @param  \App\Models\Company $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        // $company->load('contacts');

        return new CompanyResource($company);
    }

    /**
     * Update the specified company in storage.
     *
     * @param  \App\Http\Requests\CompanyRequest $request
     * @param  \App\Models\Company $company
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyRequest $request, Company $company)
    {
        $data = $request->all();

        $company->update($data);

        return new CompanyResource($company);
    }

    /**
     * Remove the specified company from storage.
     *
     * @param  \App\Models\Company $company
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Company $company)
    // {
    //     $company->delete();

    //     return Company::all()
    // }

    /**
     * Display a listing of all contacts for a companies.
     *
     * @param  \App\Models\Company $company
     * @return \Illuminate\Http\Response
     */
    public function contacts(Company $company)
    {
        $company->load('contacts');

        return new CompanyResource($company);
    }

     /**
     * Store multiple contacts for a company.
     *
     * @param  \App\Models\Company $company
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function storeContacts(Company $company, Request $request)
    {
        $collection = collect((new ContactRequest)->rules());

        $rules = collect($collection)->reject(function ($rule, $key) {
            return $key == 'company_id';
        })->mapWithKeys(function ($rule, $key) {
            return ['contacts.*.' . $key => $rule];
        })->all();

        $validator = Validator::make($request->all(), array_merge(
            ['contacts' => 'array'], $rules
        ));

        if ($validator->fails()) {
            return $validator->errors();
        }

        $validatedData = $validator->safe()->only('contacts');

        $company->contacts()->createMany($validatedData['contacts']);

        $company->load('contacts');

        return new CompanyResource($company);
    }
}
