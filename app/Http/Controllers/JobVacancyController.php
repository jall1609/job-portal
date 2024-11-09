<?php

namespace App\Http\Controllers;

use App\Models\JobVacancy;
use App\Http\Requests\StoreJobVacancyRequest;
use App\Http\Requests\UpdateJobVacancyRequest;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class JobVacancyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $auth_by_company = auth()->user()->company->id ?? null;
        return sendResponse(201,
            !empty($auth_by_company) ? 
                    JobVacancy::where('company_id', auth()->user()->company->id)->paginate(20) : 
                JobVacancy::where('status', 'active')->where(function($where){
                    $where->whereNull('application_deadline')->orWhere(function($where) {
                        $where->whereNotNull('application_deadline')->where('application_deadline', '>', now()->format('Y-m-d'));
                    });
                })->paginate(20)
            , 'Success to get your job vacancy');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'description' => 'required|string',
            'requirement' => 'required|string',
            'contract_type' => ['required', 'in:full-time,contract,intern'],
            'salary_min' => 'integer',
            'salary_max' => 'integer',
            'job_type' => 'in:WFH,WFO,hybrid',
            'location' => 'string',
            'application_deadline' => 'date'
        ]);
        
        if ($validator->fails()) {
            return sendResponse(400, $validator->errors(), 'Bad Request');
        }

        $validatedData = $validator->validated();
        $company = auth()->user()->company;

        $validatedData['slug'] = createUnixSlug($validatedData['title'] . ' '. $company->slug );
        $validatedData['company_id'] = $company->id;

        DB::beginTransaction();
        try {
            $create = JobVacancy::create($validatedData);
            $return_api = [ 201, $create, 'Job successfully created'];
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            $return_api = [ 500, $th->getMessage(), 'Internal Server Error'];
        }

        return sendResponse(...$return_api);
    }

    /**
     * Display the specified resource.
     */
    public function show(JobVacancy $jobVacancy)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJobVacancyRequest $request, JobVacancy $jobVacancy)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobVacancy $jobVacancy)
    {
        //
    }
}
