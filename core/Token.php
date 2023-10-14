<?php
namespace Core;
use Gemvc\Http\GemToken as HttpGemToken;

class Token {

    public function __construct()
    {

    }

    public static function GenerateLoginToken(int $userId,string $userMachine):string
    {
        $gemToken = new HttpGemToken();
        return $gemToken->create('login',LOGIN_TOKEN_SECRET,$userId,LOGIN_TOKEN_VALIDITY_SECOND,[],TOKEN_ISSUER,null,$userMachine);
    }

    public static function verifyLoginToken(string $token,string $userMachine):false|int
    {
        $gemToken = new HttpGemToken();
        if($gemToken->validate($token,LOGIN_TOKEN_SECRET,null,$userMachine))
        {
            return $gemToken->userId;
        }
        return false;
    }

    public static function generateAccessToken(string $userId,array $payload,string $projectName, string $userMachine , string $userIp):string
    {
        $gemToken = new HttpGemToken();
        return $gemToken->create('access',ACCESS_TOKEN_SECRET,$userId,ACCESS_TOKEN_VALIDATION_SECOND,$payload,$projectName,$userIp,$userMachine);
    }

    public static function verfiyAccessToken(string $token, string $userMachine , string $userIp):HttpGemToken|false
    {
        $gemToken = new HttpGemToken();
        if($gemToken->validate($token,ACCESS_TOKEN_SECRET,$userIp,$userMachine))
        {
            return $gemToken;
        }
        return false;
    }

    public static function generateRefreshToken(string $userId,array $payload,string $projectName, string $userMachine , string $userIp):string
    {
        $gemToken = new HttpGemToken();
        return $gemToken->create('access',REFRESH_TOKEN_SECRET,$userId,REFRESH_TOKEN_VALIDATE_SECOND,$payload,$projectName,$userIp,$userMachine);
    }

    public static function verfiyRefreshToken(string $token, string $userMachine , string $userIp):HttpGemToken|false
    {
        $gemToken = new HttpGemToken();
        if($gemToken->validate($token,REFRESH_TOKEN_SECRET,$userIp,$userMachine))
        {
            return $gemToken;
        }
        return false;
    }
}