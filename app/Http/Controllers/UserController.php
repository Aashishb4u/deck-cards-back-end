<?php

namespace App\Http\Controllers;

use App\Models\CardsModels;
use App\Models\PicturesModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use App\Helpers\AppUtility;
use App\Helpers\ApiConstant;
use Illuminate\Support\Facades\DB;

class UserController extends AppController
{
    public function signUp(Request $request)
    {
        $response = null;
        $error = null;
        $message = null;
        $userData = $request->input();

        try {
            DB::beginTransaction();
            $userModelObj = new UserModel();
            $isUserExist = $userModelObj->isUserExist($userData);

            if (empty($isUserExist)) {
                $user['name'] = $userData['name'];
                $user['password'] = bcrypt($userData['password']);
                $user['skills'] = isset($userData['skills']) ? implode(',', $userData['skills']) : null;
                $user['age'] = $userData['age'];
                $user['pictures'] = $userData['pictures'];
                $userSaveDetails = $userModelObj->saveUserDetails($user);
                $user['id_user'] = $userSaveDetails->id;

                foreach ($user['pictures'] as $picture) {
                    $picture['id_user'] = $user['id_user'];
                    $pic_data = explode('.', $picture['name']);
                    $picture['name'] = $pic_data[0];
                    $picture['extension'] = $pic_data[1];
                    $imgData = base64_decode($picture['data']);
                    $picture['picture_name'] = $picture['name'].time().'.'.$picture['extension'];
                    $error = AppUtility::validBase64Params($picture['data']);
                    if (empty($error)) {
                        $imageSaved = file_put_contents(public_path('profile_images/'.$picture['picture_name']), $imgData);
                        if (!empty($imageSaved)) {
                            $PicturesModelObject = new PicturesModel();
                            if ($error == null) {
                                $response = $PicturesModelObject->savePictures($picture);
                            } else {
                                $error = ApiConstant::IMAGE_NOT_SAVED;
                                return $this->returnableResponseData($response, $error, $message);
                            }
                        } else {
                            $error = ApiConstant::FORMAT_NOT_SUPPORTED;
                        }
                    }
                }

                if (!empty($response)) {
                        if ($userSaveDetails) {
                            $loginuser = new LoginController();
                            $response = $loginuser->login($request);
                            if (empty($response)) {
                                $error = ApiConstant::LOGGED_IN_FAILED;
                            } else {
                                DB::commit();
                            }
                        } else {
                            $error = ApiConstant::DATA_NOT_SAVED;
                        }
                }

            } else {
                $error = ApiConstant::SAME_USER_NAME;
            }
        } catch (\Exception $e) {
            $message = $e->getMessage();
            $error = ApiConstant::EXCEPTION_OCCURED;
        }
        return $this->returnableResponseData($response, $error, $message);
    }

    public function getCards(Request $request)
    {
        $response = null;
        $error = null;
        $message = null;
        try {
            $itemModelObj = new CardsModels();
            $response = $itemModelObj->getAllCards();
            if (!$response) {
                $error = ApiConstant::EXCEPTION_OCCURED;
            }
        }catch (\Exception $e) {
            $message = $e->getMessage();
            $error = ApiConstant::EXCEPTION_OCCURED;
        }
        return $this->returnableResponseData($response, $error, $message);
    }


}
