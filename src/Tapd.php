<?php

namespace Tapd;

class Tapd
{
    const TAPD_API_DOMAIN = 'https://api.tapd.cn';
    const TAPD_API_FORMAT = 'json';
    const TAPD_API_FORMAT_ITEM = ['json', 'xml'];
    const TAPD_API_AUTH = '/quickstart/testauth';

    protected $user;
    protected $pwd;
    protected $domain = self::TAPD_API_DOMAIN;
    protected $format = self::TAPD_API_FORMAT;

    public function __construct($apiUser, $apiPwd)
    {
        $this->setBasicAuth($apiUser, $apiPwd);
    }

    public function setApiFormat($format = self::TAPD_API_FORMAT)
    {
        if (!in_array($format, self::TAPD_API_FORMAT_ITEM)) {
            throw new TapdException('API format is not supported');
        }

        $this->format = $format;
    }

    public function setApiDomain($domain = self::TAPD_API_DOMAIN)
    {
        $this->domain = $domain;
    }

    public function setBasicAuth($apiUser, $apiPwd)
    {
        $this->user = $apiUser;
        $this->pwd = $apiPwd;
    }

    public function httpClient()
    {
        return (new HttpClient($this->domain))->basicAuth($this->user, $this->pwd);
    }

    public function httpGET(TapdResponseInterface $tapd, $api, $query = [])
    {
        $query['__format'] = $this->format;
        $rsp = $this->httpClient()->get($api, $query)->response();

        return $tapd->parse($rsp);
    }

    public function httpPOST(TapdResponseInterface $tapd, $api, $query = [], $data = [])
    {
        $query['__format'] = $this->format;
        $rsp = $this->httpClient()->post($api, $query, $data)->response();

        return $tapd->parse($rsp);
    }

    public function httpDELETE(TapdResponseInterface $tapd, $api, $query = [])
    {
        $query['__format'] = $this->format;
        $rsp = $this->httpClient()->delete($api, $query)->response();

        return $tapd->parse($rsp);
    }

    public function authentications()
    {
        $result = new TapdResponse();
        return $this->httpGET($result, self::TAPD_API_AUTH);
    }

}