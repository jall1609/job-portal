<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Validator; 
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function createNewToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => now()->addHours(2),
            'user' => auth()->user()
        ]);
    }

    public function registerCompany(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:6',
            'company_name' => 'required|string|between:4,150',
            'city_name' => 'required|string|between:4,50',
            'headline' => 'required|string',
            'employees_amount' => ['required', 'in:1-10,11-50,51-100,100-300,300-1000,> 1000'],
        ]);
        
        if ($validator->fails()) {
            return sendAPI(400, $validator->errors(), 'Bad Request');
        }

        $validatedData = $validator->validated();

        DB::beginTransaction();
        try {
            $create_company = (new CompanyController())->register($validatedData);
            $return_api = [ 201, $create_company, 'Company successfully created'];
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            $return_api = [ 500, $th->getMessage(), 'Internal Server Error'];
        }

        return sendAPI( ...$return_api );
    }

    public function registerCandidat(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:6',
            'name' => 'required|string|between:4,150',
            'gender' => ['required', 'in:male,female'],
            'city_name' => 'required|string|between:4,50',
            'date_of_birth' => 'required|date',
            'phone' => 'required|string|max:14',
            'linkedin_link' => 'string|max:255',
            'profile_headline' => 'string|max:255',
            'current_salary' => 'integer',
            'expected_salary' => 'integer',
            'skill' => 'string|max:255',
        ]);
        
        if ($validator->fails()) {
            return sendAPI(400, $validator->errors(), 'Bad Request');
        }

        $validatedData = $validator->validated();

        DB::beginTransaction();
        try {
            $create_candidat = (new CandidatController())->register($validatedData);
            $return_api = [ 201, $create_candidat, 'Candidat successfully created'];
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            $return_api = [ 500, $th->getMessage(), 'Internal Server Error'];
        }

        return sendAPI( ...$return_api );
    }
}
