<?php

namespace App\Http\Controllers;

use App\Models\Candidat;
use App\Http\Requests\StoreCandidatRequest;
use App\Http\Requests\UpdateCandidatRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CandidatController extends Controller
{
    public function register($validatedData)
    {
        $user = User::create([
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);
        $user->assignRole('candidat');
        $data_create_candidat = [
            'username' => createUnixSlug($validatedData['name']),
            'user_id' => $user->id,
        ];
        foreach (['name', 'city_name', 'gender', 'date_of_birth', 'phone', 'profile_headline', 'skill', 'linkedin_link', 'current_salary', 'expected_salary'] as $key => $column) {
            $data_create_candidat[$column] = $validatedData[$column] ?? null;
        }
        $candidat = Candidat::create($data_create_candidat);

        return collect($data_create_candidat)->except(['user_id', 'id'])->merge([
            'email' => $validatedData['email']
        ])->toArray();
    }
}
