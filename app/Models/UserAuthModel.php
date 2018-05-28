<?php

namespace App\Models;

use App\BaseModels\BaseUserAuthModel;
use App\Helpers\ApiConstant;
use App\Helpers\AppUtility;


class UserAuthModel extends BaseUserAuthModel
{
    public function saveAuthToken($userData)
    {
        $response = ApiConstant::DATA_NOT_SAVED;
        $auth_token = bcrypt($userData['password'] . $userData['name']);
        $this->id_user = $userData['id'];
        $this->auth_token = $auth_token;
        if ($this->save()) {
            $response = $this->auth_token;
        }
        return $response;
    }

    public function getUserByAuthToken($auth_token)
    {
        $user = $this::where('auth_token', $auth_token)->first();
        return $user;
    }

    public function deleteToken($auth_token, $authenticatedUserId)
    {
        $user = $this::where('auth_token', $auth_token)->where('id_user', $authenticatedUserId)->delete();
        return $user;
    }
}
