<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * @group Auth
 */
class LogoutController extends Controller
{
    public function __invoke(Request $request)
    {
        if (auth()->check()) {
            // User is authenticated, now you can access the currentAccessToken
            auth()->user()->currentAccessToken()->delete;
            return response()->noContent();
        }

        $user = auth()->user();

        if ($user) {
            $accessToken = $user->currentAccessToken();
            
            return reset($accessToken->token);
        } else {
            // Handle the case where no user is authenticated
            return response()->json([
                'message' => 'no auth',
            ]);
        }

        // auth()->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'logged out fail',
        ]);
    }
}
