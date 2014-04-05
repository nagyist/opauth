<?php
/**
 * Opauth
 * Multi-provider authentication framework for PHP
 *
 * @copyright    Copyright © 2014 U-Zyn Chua (http://uzyn.com)
 * @link         http://opauth.org
 * @license      MIT License
 */
namespace Opauth\Opauth\HttpClient;

use Opauth\Opauth\OpauthException;

/**
 * Opauth File
 * File client class, uses file_get_contents for environments where curl is not available
 *
 */
class File extends Base
{

    /**
     * Makes a request using file_get_contents
     *
     * @param string $url
     * @param array $options
     * @return string Response body
     * @throws \Exception
     */
    protected function request($url, $options = array())
    {
        if (!ini_get('allow_url_fopen')) {
            throw new OpauthException('file_get_contents not allowed, try using other http_client such as curl');
        }
        $context = null;
        if (!empty($options)) {
            $context = stream_context_create($options);
        }
        $content = file_get_contents($url, false, $context);
        $this->responseHeaders = implode("\r\n", $http_response_header);
        return $content;
    }
}