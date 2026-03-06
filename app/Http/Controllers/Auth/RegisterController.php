<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        $validator = Validator::make(
            $data,
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'user_category' => ['required', 'in:nation,non_nation'],
                'interest_1' => ['required', 'string'],
                'interest_2' => ['nullable', 'string'],
                'interest_3' => ['nullable', 'string'],
                'interest_4' => ['nullable', 'string'],
                'interest_5' => ['nullable', 'string'],
                'password' => [
                    'required',
                    'string',
                    'min:8',
                    'confirmed',
                    'regex:/^(?=(?:.*[A-Z]){2,})(?=(?:.*\d){2,})(?=(?:.*[^A-Za-z0-9]){2,}).{8,}$/',
                ],
            ],
            [
                'password.regex' => 'Password must contain at least 8 characters, 2 uppercase letters, 2 numbers, and 2 symbols.',
            ]
        );

        $validator->after(function ($validator) use ($data) {
            $interests = array_filter([
                $data['interest_1'] ?? null,
                $data['interest_2'] ?? null,
                $data['interest_3'] ?? null,
                $data['interest_4'] ?? null,
                $data['interest_5'] ?? null,
            ]);

            if (count($interests) !== count(array_unique($interests))) {
                $validator->errors()->add('event_interests', 'Please do not select the same interest more than once.');
            }
        });

        return $validator;
    }

    protected function create(array $data)
    {
        $interests = array_values(array_filter([
            $data['interest_1'] ?? null,
            $data['interest_2'] ?? null,
            $data['interest_3'] ?? null,
            $data['interest_4'] ?? null,
            $data['interest_5'] ?? null,
        ]));

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'user',
            'user_category' => $data['user_category'],
            'event_interests' => $interests,
            'active' => 1,
            'deleted' => 0,
        ]);
    }
}