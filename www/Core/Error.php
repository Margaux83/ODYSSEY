<?php

namespace App\Core;
use App\Core\View;

class Error 
{
    private static $_responseCodes = [
        '400' => '400: Bad Request',
        '401' => '401: Unauthorized',
        '402' => '402: Payment Required',
        '403' => '403: Forbidden',
        '404' => '404: Not Found',
        '405' => '405: Method Not Allowed',
        '406' => '406: Not Acceptable',
        '407' => '407: Proxy Authentication Required',
        '408' => '408: Request Time-out',
        '409' => '409: Conflict',
        '410' => '410: Gone',
        '411' => '411: Length Required',
        '412' => '412: Precondition Failed',
        '413' => '413: Request Entity Too Large',
        '414' => '414: Request-URI Too Long',
        '415' => '415: Unsupported Media Type',
        '416' => '416: Requested range unsatisfiable',
        '417' => '417: Expectation failed',
        '418' => '418: I’m a teapot',
        '421' => '421: Bad mapping / Misdirected Request',
        '422' => '422: Unprocessable entity',
        '423' => '423: Locked',
        '424' => '424: Method failure',
        '425' => '425: Too Early',
        '426' => '426: Upgrade Required',
        '428' => '428: Precondition Required',
        '429' => '429: Too Many Requests',
        '431' => '431: Request Header Fields Too Large',
        '449' => '449: Retry With',
        '450' => '450: Blocked by Windows Parental Controls',
        '451' => '451: Unavailable For Legal Reasons',
        '456' => '456: Unrecoverable Error',
        '444' => '444: No Response',
        '495' => '495: SSL Certificate Error',
        '496' => '496: SSL Certificate Required',
        '497' => '497: HTTP Request Sent to HTTPS Port',
        '498' => '498: Token expired/invalid',
        '499' => '499: Client Closed Request',
        '500' => '500: Internal Server',
        '501' => '501: Not Implemented',
        '502' => '502: Bad Gateway / Proxy Error',
        '503' => '503: Service Unavailable',
        '504' => '504: Gateway Time-out',
        '505' => '505: HTTP Version not supported',
        '506' => '506: Variant Also Negotiates',
        '507' => '507: Insufficient storage',
        '508' => '508: Loop detected',
        '509' => '509: Bandwidth Limit Exceeded',
        '510' => '510: Not extended',
        '511' => '511: Network authentication required',
        '520' => '520: Unknown Error',
        '521' => '521: Web Server Is Down',
        '522' => '522: Connection Timed Out',
        '523' => '523: Origin Is Unreachable',
        '524' => '524: A Timeout Occurred',
        '525' => '525: SSL Handshake Failed',
        '526' => '526: Invalid SSL Certificate',
        '527' => '527: Railgun Error',
    ];

    public static function errorPage($responseCode, $messageSent = ""){
        $responseMessage = $messageSent !== "" ? $messageSent : self::$_responseCodes[strval($responseCode)];
        header($responseMessage, true, $responseCode);
        $view = new View("Error/error_page", "error");
        $view->assign('responseCode', $responseCode);
        $view->assign('responseMessage', $responseMessage);
    }
}