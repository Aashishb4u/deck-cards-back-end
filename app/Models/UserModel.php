<?php
namespace App\Models;
use App\BaseModels\BaseUserModel;

class UserModel extends BaseUserModel
{
    public function saveUser($userData)
    {
        $name = $userData['name'];
        $password = bcrypt($userData['password']);
        $this->name = $name;
        $this->passsword = bcrypt($password);
        $this->save();
    }


    public function isUserExist($userData) {
        $response = null;
        $response = $this::where('name', $userData['name'])->first();
        return $response;
    }

    public function saveUserDetails($user)
    {
        $returnData = null;
        $this->name = $user['name'];
        $this->password = $user['password'];
        $this->age = $user['age'];
        $this->skills = $user['skills'];

        if ($this->save()) {
            $returnData = $this;
        }

        return $returnData;
    }



}