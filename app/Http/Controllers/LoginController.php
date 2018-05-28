<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use App\Helpers\ApiConstant;
use App\Helpers\AppUtility;
use App\Models\UserAuthModel;


class LoginController extends AppController
{
    public function login(Request $request)
    {
        $loginData = $request->input();
        $returnableUserData = null;
        $userData['name'] = AppUtility::trimContent($loginData['name']);
        $userData['password'] = isset($loginData['password']) ? $loginData['password'] : null;
        $result = null;
        $response = null;
        $error = null;
        try {
            $userModelObj = new UserModel();
            $user['name'] = $userData['name'];
            $userDetails = $userModelObj->isUserExist($userData);
            $userData['id'] = $userDetails->id;
            if (!empty($userDetails)) {
                $result = password_verify($userData['password'], $userDetails['password']);
                if ($result) {
                    $userAuthModelObj = new UserAuthModel();
                    $response = $userAuthModelObj->saveAuthToken($userData);
                    if ($response) {
                        $returnableUserData = array('message' => ApiConstant::LOGGED_IN_SUCCESSFULLY,
                            'auth_token' => $response,
                            'user_name' => $userData['name'],
                        );
                    }
                } else {
                        $error = ApiConstant::INVALID_USERNAME_PASSWORD;
                }
            } else {
                $error = ApiConstant::USER_NOT_REGISTERED;
            }
        } catch (\Exception $e) {
            return $this->returnableResponseData($userData, ApiConstant::EXCEPTION_OCCURED, ApiConstant::LOGGED_IN_FAILED);
        }
        return $this->returnableResponseData($returnableUserData, $error);
     }

    public function logout(Request $request)
    {
        $headerInfo = $request->header();
        $authorization = $headerInfo['authorization'][0] ?? '';
        $auth_token = explode(' ', $authorization);
        $auth_token = $auth_token[1] ?? '';
        $user = new UserAuthModel();
        $authenticatedUser = $user->getUserByAuthToken($auth_token);
        $error = null;
        $userData = array();
        $authenticatedUserId = $authenticatedUser['id_user'];
        if (!empty($authenticatedUser['id_user'])) {
            try {
                if (!empty($auth_token)) {
                    $userAuthModelObj = new UserAuthModel();
                    $userDbAuthToken = $userAuthModelObj->deleteToken($auth_token, $authenticatedUserId);
                    if ($userDbAuthToken == 1) {
                        $userData = array('code' => ApiConstant::HTTP_RESPONSE_CODE_SUCCESS,
                            'message' => ApiConstant::LOGGED_OUT_SUCCESSFULLY,
                        );
                    } else {
                        $error = ApiConstant::LOGGED_IN_FAILED;
                    }
                }
            } catch (\Exception $e) {
                $error = ApiConstant::EXCEPTION_OCCURED;
            }
        }
        return $this->returnableResponseData($userData, $error);
    }
}

