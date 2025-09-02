<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Interfaces\AuthRepositoryInterface;

class AuthController extends Controller
{
    protected $authRepository;

    public function __construct(AuthRepositoryInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function registerForm()
    {
        return view('pages.auth.register');
    }

    public function storeRegister(RegisterRequest $request)
    {
        $data = $request->validated();

        $this->authRepository->register($data);

        return redirect()->route('home');
    }
}
