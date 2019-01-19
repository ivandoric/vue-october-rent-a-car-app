<?php

namespace RLuders\JWTAuth\Http\Controllers;

use Auth;
use Mail;
use Event;
use Validator;
use Illuminate\Http\Response;
use RainLab\User\Models\User;
use RLuders\JWTAuth\Classes\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use RLuders\JWTAuth\Http\Requests\LoginRequest;
use RainLab\User\Models\Settings as UserSettings;
use RLuders\JWTAuth\Models\Settings;
use RLuders\JWTAuth\Http\Requests\RegisterRequest;
use Illuminate\Routing\Controller as BaseController;
use RLuders\JWTAuth\Http\Requests\ActivationRequest;
use RLuders\JWTAuth\Http\Requests\ResetPasswordRequest;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use RLuders\JWTAuth\Http\Requests\ForgotPasswordRequest;
use RLuders\JWTAuth\Http\Requests\TokenRequest;

class AuthController extends BaseController
{
    /**
     * The JWTAuth
     *
     * @var RLuders\JWTAuth\Classes\JWTAuth
     */
    protected $auth;

    /**
     * Controller constructor
     *
     * @param RLuders\JWTAuth\Classes\JWTAuth $auth
     */
    public function __construct(JWTAuth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Get login field attribute
     *
     * @return string
     */
    protected function getLoginAttribute()
    {
        return UserSettings::get('login_attribute', UserSettings::LOGIN_EMAIL);
    }

    /**
     * Flag for allowing registration, pulled from UserSettings
     *
     * @return string
     */
    public function canRegister()
    {
        return UserSettings::get('allow_registration', true);
    }

    /**
     * Sends the forgot password email to a user
     *
     * @param User $user
     * @return void
     */
    protected function sendResetPasswordEmail(User $user)
    {
        $code = implode('!', [$user->id, $user->getResetPasswordCode()]);
        $link = $this->makeResetPasswordUrl($code);

        $data = [
            'name' => $user->name,
            'link' => $link,
            'code' => $code
        ];

        Mail::send(
            'rainlab.user::mail.restore',
            $data,
            function ($message) use ($user) {
                $message->to($user->email, $user->full_name);
            }
        );
    }

    /**
     * Create the password reset URL
     *
     * @param string $code
     * @return string
     */
    protected function makeResetPasswordUrl($code)
    {
        $url = Settings::get('reset_password_url');
        $url = str_replace('{code}', $code, $url);

        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            $url = url($url);
        }

        return $url;
    }

    /**
     * Sends the activation email to a user
     *
     * @param  User $user
     * @return void
     */
    protected function sendActivationEmail(User $user)
    {
        $code = implode('!', [$user->id, $user->getActivationCode()]);
        $link = $this->makeActivationUrl($code);

        $data = [
            'name' => $user->name,
            'link' => $link,
            'code' => $code
        ];

        Mail::send(
            'rainlab.user::mail.activate',
            $data,
            function ($message) use ($user) {
                $message->to($user->email, $user->name);
            }
        );
    }

    /**
     * Returns a link used to activate the user account.
     *
     * @return string
     */
    protected function makeActivationUrl($code)
    {
        $url = Settings::get('activation_url');
        $url = str_replace('{code}', $code, $url);

        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            $url = url($url);
        }

        return $url;
    }

    /**
     * Authenticate user
     *
     * @param  LoginRequest $request
     * @return Illuminate\Http\Response
     */
    public function authenticate(LoginRequest $request)
    {
        $credentials = $request->getCredentials();

        Event::fire('rainlab.user.beforeAuthenticate', [$this, $credentials]);

        try {
            if (!$token = $this->auth->attempt($credentials)) {
                return response()->json(
                    [
                        'error' => 'invalid_credentials'
                    ],
                    Response::HTTP_UNAUTHORIZED
                );
            }
        } catch (JWTException $e) {
            return response()->json(
                [
                    'error' => 'could_not_create_token'
                ],
                Response::HTTP_UNAUTHORIZED
            );
        }

        $user = $this->auth->setToken($token)->authenticate();

        if ($user->isBanned()) {
            $this->auth->parseToken()->invalidate();
            return response()->json(
                [
                    'error' => 'user_is_banned'
                ],
                Response::HTTP_UNAUTHORIZED
            );
        }

        if (!$user->is_activated) {
            $this->auth->parseToken()->invalidate();
            return response()->json(
                [
                    'error' => 'user_inactive'
                ],
                Response::HTTP_UNAUTHORIZED
            );
        }

        return response()->json(compact('token', 'user'));
    }

    /**
     * Create user account
     *
     * @param  RegisterRequest $request
     * @return Illuminate\Http\Response
     */
    public function register(RegisterRequest $request)
    {
        if (!$this->canRegister()) {
            return response()->json(
                [
                    'error' => 'registration_disabled'
                ],
                Response::HTTP_UNAUTHORIZED
            );
        }

        $data = $request->all();

        Event::fire('rainlab.user.beforeRegister', [&$data]);

        $userActivation = UserSettings::get('activate_mode') == UserSettings::ACTIVATE_USER;
        $automaticActivation = UserSettings::get('activate_mode') == UserSettings::ACTIVATE_AUTO;

        $user = $this->auth->register($data, $automaticActivation);

        Event::fire('rainlab.user.register', [$user, $data]);

        if ($userActivation) {
            $this->sendActivationEmail($user);
        }

        return response()->json([], Response::HTTP_CREATED);
    }

    /**
     * Activate user account
     *
     * @param  ActivationRequest $request
     * @return Illuminate\Http\Response
     */
    public function accountActivation(ActivationRequest $request)
    {
        $code = $request->get('activation_code');
        $parts = explode('!', $code);

        if (count($parts) != 2) {
            return response()->json(
                [
                    'error' => 'invalid_activation_code'
                ],
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        list($userId, $code) = $parts;

        if (!strlen(trim($userId)) || !strlen(trim($code))) {
            return response()->json(
                [
                    'error' => 'invalid_user'
                ],
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        if (!$user = $this->auth->findUserById($userId)) {
            return response()->json(
                [
                    'error' => 'user_not_found'
                ],
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        if (!$user->attemptActivation($code)) {
            return response()->json(
                [
                    'error' => 'invalid_activation_code'
                ],
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        // @TODO Autologin

        return response()->json([]);
    }

    /**
     * Request for password reset
     *
     * @param  ForgotPasswordRequest $request
     * @return Illuminate\Http\Response
     */
    public function forgotPassword(ForgotPasswordRequest $request)
    {
        $email = $request->get('email');

        if (!$user = User::findByEmail($email)) {
            return response()->json(
                [
                    'error' => 'user_not_found'
                ],
                Response::HTTP_NOT_FOUND
            );
        }

        $this->sendResetPasswordEmail($user);

        return response()->json([]);
    }

    /**
     * Reset user password
     *
     * @param  ResetPasswordRequest $request
     * @return Illuminate\Http\Response
     */
    public function resetPassword(ResetPasswordRequest $request)
    {
        $code = $request->get('reset_password_code');
        $parts = explode('!', $code);

        if (count($parts) != 2) {
            return response()->json(
                [
                    'error' => 'invalid_reset_password_code'
                ],
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        list($userId, $code) = $parts;

        if (!strlen(trim($userId)) || !($user = User::find($userId))) {
            return response()->json(
                [
                    'error' => 'invalid_user'
                ],
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        if (!$user->attemptResetPassword($code, $request->get('password'))) {
            return response()->json(
                [
                    'error' => 'invalid_reset_password_code'
                ],
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        return response()->json([]);
    }

    /**
     * Update authenticated user token
     *
     * @return Illuminate\Http\Response
     */
    public function refreshToken(TokenRequest $request)
    {
        $token = $request->get('token');
        $this->auth->setToken($token);

        try {
            if (!$token = $this->auth->refresh($token)) {
                return response()->json(
                    [
                        'error' => 'could_not_refresh_token'
                    ],
                    Response::HTTP_FORBIDDEN
                );
            }
        } catch (TokenBlacklistedException $e) {
            return response()->json(
                [
                    'error' => 'given_token_was_blacklisted'
                ],
                Response::HTTP_FORBIDDEN
            );
        }

        $this->auth->setToken($token);

        return response()->json(compact('token'));
    }

    /**
     * Get the authenticated user
     *
     * @return Illuminate\Http\Response
     */
    public function getUser()
    {
        if (!$user = $this->auth->user()) {
            return response()->json(
                [
                    'error' => 'user_not_found'
                ],
                Response::HTTP_NOT_FOUND
            );
        }

        return response()->json(compact('user'));
    }
}
