<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Api\Auth;

use App\Action\Auth\GetAuthenticatedUserAction;
use App\Action\Auth\LoginAction;
use App\Action\Auth\LoginRequest;
use App\Action\Auth\LogoutAction;
use App\Action\Auth\RegisterAction;
use App\Action\Auth\RegisterRequest;
use App\Http\Controllers\ApiController;
use App\Http\Presenter\Auth\AuthenticationResponseArrayPresenter;
use App\Http\Presenter\User\UserArrayPresenter;
use App\Http\Request\Api\Auth\RegisterHttpRequest;
use App\Http\Request\Api\Auth\LoginHttpRequest;

class AuthController extends ApiController
{
    public function __construct()
    {
		$this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function register(
        RegisterHttpRequest $httpRequest,
        RegisterAction $action,
        AuthenticationResponseArrayPresenter $authenticationResponseArrayPresenter
    ) {
        $request = new RegisterRequest(
            $httpRequest->email,
            $httpRequest->password,
            $httpRequest->name
        );
        $response = $action->execute($request);

        return $this->createSuccessResponse($authenticationResponseArrayPresenter->present($response));
    }

    public function login(
        LoginHttpRequest $httpRequest,
        LoginAction $action,
        AuthenticationResponseArrayPresenter $authenticationResponseArrayPresenter
    ) {
        $request = new LoginRequest(
            $httpRequest->email,
            $httpRequest->password
        );
        $response = $action->execute($request);

        return $this->createSuccessResponse($authenticationResponseArrayPresenter->present($response));
    }

    public function me(GetAuthenticatedUserAction $action, UserArrayPresenter $userArrayPresenter)
	{
	    $response = $action->execute();

		return $this->createSuccessResponse($userArrayPresenter->present($response->getUser()));
	}

    public function logout(LogoutAction $action)
    {
        $action->execute();

        return $this->createEmptyResponse();
    }
}
