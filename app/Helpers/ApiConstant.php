<?php
namespace App\Helpers;

class ApiConstant
{
    /**
     * Failure Messages
     */
    const AUTHENTICATION_FAILED = '-101';
    const LOGGED_IN_FAILED = '-102';
    const USER_NOT_REGISTERED = '-103';
    const SAME_USER_NAME = '-104';
    const DATA_NOT_SAVED = '-105';
    const ADD_PICTURE_FAILED = '-106';
    const FORMAT_NOT_SUPPORTED = '-107';
    const EXCEPTION_OCCURED = '-108';
    const INVALID_USERNAME_PASSWORD = '-109';
    const IMAGE_NOT_SAVED = '-110';
    const SUCCESS_CODE = 0;
    const ERROR_STATUS = -1;
    const HTTP_RESPONSE_CODE_SUCCESS = 200;
    const CREATED =201;
    const DEFAULT_ERROR_RESPONSE_CODE = 400;
    const HTTP_RESPONSE_CODE_FAILED_AUTHENTICATION = 401;



    /**
     * Success Messages
     */
    const SUCCESSFULLY_ADD = 'User added successfully';
    const LOGGED_IN_SUCCESSFULLY = 'User added successfully';
    const LOGGED_OUT_SUCCESSFULLY = 'User logged out successfully';


    public static $english = array(
        ApiConstant::AUTHENTICATION_FAILED => 'User authentication failed',
        ApiConstant::LOGGED_IN_FAILED => 'LogIn failed',
        ApiConstant::USER_NOT_REGISTERED => 'User authentication failed',
        ApiConstant::SAME_USER_NAME => 'User name already exist',
        ApiConstant::DATA_NOT_SAVED => 'failed to save data',
        ApiConstant::ADD_PICTURE_FAILED => 'Failed to add pictures',
        ApiConstant::INVALID_USERNAME_PASSWORD => 'Username or password is invalid',
        ApiConstant::FORMAT_NOT_SUPPORTED => 'Image format is not supported',
        ApiConstant::IMAGE_NOT_SAVED => 'Failed to save image',
        ApiConstant::LOGGED_IN_SUCCESSFULLY => 'Failed to save image',
    );
}