<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function login(LoginRequest $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = $request->user();
            if ($user) {
                return $this->createTokenData($user);
            }
        }

        return response()->json([
            'email' => __('Unauthorized'),
        ], 401);
    }

    /**
     * createTokenData
     * @param Request $request
     * return \Illuminate\Http\Response
     */
    public function createTokenData($user)
    {
        $tokenResult = $user->createToken('@D@M0D1G1T4L%$#$$#');
        $token = $tokenResult->token;
        $token->save();
        return response()->json([
            'message' => __('Success'),
            'access_token' => 'Bearer ' . $tokenResult->accessToken,
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString(),
        ]);
    }
}
