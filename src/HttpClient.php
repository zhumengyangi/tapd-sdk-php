<?php

namespace Tapd;

class HttpClient
{
    private $_curl;
    private $_domain;
    private $_basicAuth;

    public function __construct($domain)
    {
        $this->_domain = $domain;
        $this->flush();
    }

    public function __destruct()
    {
        curl_close($this->_curl);
    }

    private function _url($api, $query = [])
    {
        $url = trim($api, '/');
        if (stripos($api, $this->_domain) === false) {
            $url = trim($this->_domain, '/') . '/' . $api;
        }
        if (!empty($query)) {
            $url = $url . '?' . http_build_query((array) $query);
        }

        curl_setopt($this->_curl, CURLOPT_URL, $url);
        return $this;
    }

    public function flush()
    {
        $this->_curl = curl_init();
        curl_setopt($this->_curl, CURLOPT_RETURNTRANSFER, true);
        return $this;
    }

    public function basicAuth($user, $pwd)
    {
        if (!empty($user) && !empty($pwd)) {
            $this->_basicAuth = "$user:$pwd";
        }
        return $this;
    }

    public function get($api, $query = [])
    {
        return $this->_url($api, $query);
    }

    public function post($api, $query = [], $data = [])
    {
        curl_setopt($this->_curl, CURLOPT_POST, true);
        curl_setopt($this->_curl, CURLOPT_POSTFIELDS, $data);
        return $this->_url($api, $query);
    }

    public function delete($api, $query = [])
    {
        curl_setopt($this->_curl, CURLOPT_CUSTOMREQUEST, 'DELETE'); // DELETE方式
        return $this->_url($api, $query);
    }

    public function response()
    {
        if (!empty($this->_basicAuth)) {
            curl_setopt($this->_curl, CURLOPT_USERPWD, $this->_basicAuth);
        }

        $response = curl_exec($this->_curl);
        $result = json_decode($response, true);
        if (is_null($result)) {
            return $response;
        }
        return $result;
    }
}