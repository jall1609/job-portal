<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; 
use Illuminate\Support\Facades\Validator; 

class CompanyController extends Controller
{
    public function register($validatedData)
    {
        $user = User::create([
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);
        $user->assignRole('company');
        $data_create_company = [
            'company_name' => $validatedData['company_name'],
            'slug' => createUnixSlug($validatedData['company_name']),
            'user_id' => $user->id,
            'city_name' => $validatedData['city_name'],
            'headline' => $validatedData['headline'],
            'employees_amount' => $validatedData['employees_amount'],
        ];
        $company = Company::create($data_create_company);

        return [
            'company' => collect($data_create_company)->except(['user_id', 'id'])->merge([
                'email' => $validatedData['email']
            ])->toArray()
        ];
    }
}
