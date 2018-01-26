<?php
namespace SvyaznoyApi;

use SvyaznoyApi\Http\Request;

interface AuthenticatorInterface
{

    public function setAuthType(string $authType): void;
    public function getToken();
    public function refreshToken();
    public function addAuthData(Request $request);

}