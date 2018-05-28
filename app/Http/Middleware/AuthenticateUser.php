<?php
namespace App\Http\Middleware;

//use App\Helpers\ApiConstant;
use App\Helpers\ApiConstant;
use App\Http\Controllers\AppController;
use App\Models\UserAuthModel;
use Closure;

class AuthenticateUser extends AppController
{
    public function handle($request, Closure $next){
        $headerInfo = $request->header();
        $authorization = $headerInfo['authorization'][0] ?? '';
        $token = explode(' ', $authorization);
        $token = $token[1] ?? '';
        if (empty($token)) {
            return $this->returnableResponseData(array(), ApiConstant::AUTHENTICATION_FAILED);
        }

        $user = new UserAuthModel();
        $authenticatedUser = $user->getUserByAuthToken($token);
        if (!$authenticatedUser) {
            return $this->returnableResponseData(array(), ApiConstant::AUTHENTICATION_FAILED);
        }
        $request->auth_token = $token;
        $uri = $request->getBaseUrl();
        $host = $request->getHost();
        $basePath = 'http://' . $host . $uri;
        $request->rootUrl = $basePath;
        $request->user = $authenticatedUser;
        return $next($request);
    }
}