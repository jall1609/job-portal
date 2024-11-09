<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreApplicationRequest;
use App\Http\Requests\UpdateApplicationRequest;
use App\Models\Application;
use App\Models\Candidat;
use App\Models\JobVacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator; 

class ApplicationController extends Controller
{
    public function apply(Request $request, JobVacancy $jobVacancy)
    {
        $validator = Validator::make($request->all(), [
            'cover_letter' => 'string',
            'resume_link' => 'string',
        ]);

        if ($validator->fails()) {
            return sendResponse(400, $validator->errors(), 'Bad Request');
        }

        $validatedData = $validator->validated();

        if($jobVacancy->status == 'inactive' || (!empty($jobVacancy->application_deadline) && $jobVacancy->application_deadline < now()) ) return sendResponse(200, null, 'Job Vacancy is Inactive');

        DB::beginTransaction();
        try {
            $apply =  Application::create([
                'candidat_id' => auth()->user()->candidat->id,
                'job_vacancy_id' => $jobVacancy->id,
                'cover_letter' => $validatedData['cover_letter'] ?? null,
                'resume_link' => $validatedData['resume_link'] ?? null,
                'status' => 'application',
                'logs_status' => json_encode([
                    'application' => now()
                ]),
            ]);
            $return_api = [ 201, $apply, 'Company successfully created'];
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            $return_api = [ 500, $th->getMessage(), 'Internal Server Error'];
        }

        return sendResponse( ...$return_api );
    }

    public function getApplicantByJob(Request $request, JobVacancy $jobVacancy)
    {
        return sendResponse(201, [
            'job_vacancy' => $jobVacancy->title,
            'applicant' => Application::where('job_vacancy_id', $jobVacancy->id)->with('candidat')->paginate(20)
        ], 'Success get Applicant by Job Vacancy');
    }

    public function changeStatusCandidat(Request $request, JobVacancy $jobVacancy, Candidat $candidat)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'in:application,cv screening,interview HR,interview User,technical test,offering,hired,rejected',
        ]);

        if ($validator->fails()) {
            return sendResponse(400, $validator->errors(), 'Bad Request');
        }

        if(Gate::allows('job_vacancy_owner', $jobVacancy) == false) {
            return sendResponse(403, null,'You do not have permission to access this resource');
        }

        $validatedData = $validator->validated();

        DB::beginTransaction();
        try {
            Application::where('job_vacancy_id', $jobVacancy->id)->where('candidat_id', $candidat->id)->update(['status' => $validatedData['status']]);
            $return_api = [ 201, null, 'Change status successfully'];
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            $return_api = [ 500, $th->getMessage(), 'Internal Server Error'];
        }

        return sendResponse( ...$return_api );
    }

    public function getMyApplication()
    {
        try {
            $application = Application::where('candidat_id', auth()->user()->candidat->id)->with('job_vacancy')->get();
            $return_api = [ 201, $application, 'Change status successfully'];
        } catch (\Throwable $th) {
            $return_api = [ 500, $th->getMessage(), 'Internal Server Error'];
        }
        
        return sendResponse( ...$return_api );
    }
}
