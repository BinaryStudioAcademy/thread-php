<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Http\Requests\Api\Auth\RegisterHttpRequest;
use App\Http\Requests\Api\Auth\LoginHttpRequest;
use App\Requests\Auth\RegisterRequest;
use App\Requests\Auth\LoginRequest;
use App\Actions\Auth\RegisterAction;
use App\Actions\Auth\LoginAction;
use App\Presenters\Auth\AuthPresenter;

class AuthController extends ApiController
{
    private $authPresenter;

    public function __construct(AuthPresenter $authPresenter)
    {
        $this->authPresenter = $authPresenter;
    }

    public function register(RegisterHttpRequest $httpRequest, RegisterAction $action)
    {
        $request = new RegisterRequest(
            $httpRequest->email,
            $httpRequest->password,
            $httpRequest->name
        );
        $response = $action->execute($request);

        return $this->createSuccessResponse($this->authPresenter->presentAuthenticateResponse($response));
    }

    public function login(LoginHttpRequest $httpRequest, LoginAction $action)
    {
        $request = new LoginRequest(
            $httpRequest->email,
            $httpRequest->password
        );
        $response = $action->execute($request);

        return $this->createSuccessResponse($this->authPresenter->presentAuthenticateResponse($response));
    }

    public function logout()
    {
        auth()->logout();

        return $this->createEmptyResponse();
    }
}
