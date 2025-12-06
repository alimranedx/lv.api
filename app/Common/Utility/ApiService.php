<?php

namespace App\Common\Utility;

class ApiService
{
    const API_SERVICE_SUCCESS_CODE = 100;
    const API_SERVICE_FAILED_CODE = 422;
    const API_SERVICE_UNAUTHENTICATED = 401;
    const API_SERVICE_DB_COMMIT_ROLLBACK = 150;

    const API_SERVICE_DEFAULT_VALIDATION_ERROR = 1001;
    const API_SERVICE_IP_VALIDATION_ERROR= 1002;
    const API_SERVICE_HASHKEY_VALIDATION_ERROR= 1003;
    const API_SERVICE_CURRENCY_NOT_SUPPORTED = 1004;
    const API_SERVICE_ITEM_TOTAL_MISMATCH = 1005;
    const API_SERVICE_NAME_MISMATCH_WITH_HASH_KEY = 1006;
    const API_SERVICE_SURNAME_MISMATCH_WITH_HASH_KEY = 1007;
    const API_SERVICE_BIRTH_YEAR_MISMATCH_WITH_HASH_KEY = 1008;
    const API_SERVICE_IP_ADDRESS_MISMATCH_WITH_HASH_KEY = 1009;
    const API_SERVICE_HASH_KEY_MISMATCH = 1010;
    const API_SERVICE_KYC_INVALID_USER = 1011;
    const API_SERVICE_INVALID_CHARACTER_IN_REQUEST = 1012;
    const API_SERVICE_DUPLICATE_REQUEST_ERROR = 1013;
    const API_SERVICE_JWT_VERIFICATION_ERROR = 1014;
    const API_SERVICE_ITEMS_CAN_NOT_BE_EMPTY = 1015;



    const API_SERVICE_ALREADY_CREATED = 1021; // ALREADY CREATED
    const API_SERVICE_NO_DATA_FOUND = 1022; // No data found

    CONST API_SERVICE_FP_MT_FILE_ALREADY_EXISTS = 1026; // FP MT FILE ALREADY EXISTS


    CONST API_SERVICE_GOOGLE_RECAPTCHA_VALIDATION_FAILED = 1030; // google recaptcha validation failed

    CONST API_SERVICE_OTP_RATE_LIMIT_TIME = 1037;



    const API_SERVICE_USER_NOT_FOUND = 2001;



    // Status description message
    const API_SERVICE_STATUS_MESSAGE = [

        self::API_SERVICE_SUCCESS_CODE => "Successful",
        self::API_SERVICE_FAILED_CODE => "Failed",
        self::API_SERVICE_NO_DATA_FOUND => "No data found",
        //'REQUEST': PREFIX [E-10], 'http_code' = 400
        self::API_SERVICE_IP_VALIDATION_ERROR=> "This ip is not allowed",
        self::API_SERVICE_HASHKEY_VALIDATION_ERROR=> "Invalid Request",
        self::API_SERVICE_DEFAULT_VALIDATION_ERROR => "Validation Error",
        self::API_SERVICE_CURRENCY_NOT_SUPPORTED =>  "",

        //'IDENTIFICATION': PREFIX [E-20], 'http_code' = 200

        self::API_SERVICE_USER_NOT_FOUND =>  "User not found",

        self::API_SERVICE_NAME_MISMATCH_WITH_HASH_KEY => "Name mismatch with hash_key",
        self::API_SERVICE_SURNAME_MISMATCH_WITH_HASH_KEY => "Surname mismatch with hash_key",
        self::API_SERVICE_BIRTH_YEAR_MISMATCH_WITH_HASH_KEY => "Birth year mismatch with hash_key",
        self::API_SERVICE_IP_ADDRESS_MISMATCH_WITH_HASH_KEY => "IP address mismatch with hash_key",
        self::API_SERVICE_HASH_KEY_MISMATCH => "Hash key mismatch",
        self::API_SERVICE_KYC_INVALID_USER => "KYC verification failed",

        self::API_SERVICE_GOOGLE_RECAPTCHA_VALIDATION_FAILED => "Sorry! Google recaptcha detected you as a bot.",
        self::API_SERVICE_OTP_RATE_LIMIT_TIME => "Please try after :time minutes.",

    ];

















    const API_SERVICE_HTTP_CODE_VALID_REQUEST = 200;
    const API_SERVICE_HTTP_CODE_BAD_REQUEST = 400;


}
