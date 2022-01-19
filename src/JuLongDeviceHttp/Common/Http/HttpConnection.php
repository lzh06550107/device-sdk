<?php

declare(strict_types=1);

namespace JuLongDeviceHttp\Common\Http;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\CurlHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\RequestInterface;

/**
 * http连接类
 * Created on 2021/12/23 9:54
 * Create by LZH
 */
class HttpConnection
{
    private $client;
    private $profile;

    function __construct($url, $profile)
    {
        $stack = new HandlerStack();
        $stack->setHandler(new CurlHandler()); //使用 HandlerStack 后必须指定一个 Handler
        $stack->push(Middleware::mapRequest(function (RequestInterface $request) {
            /**
             * @var Request $request
             * @var Response $response
             */
            $requestBody = $request->getBody();
            $requestBody->rewind();

            //请求头
            $requestHeaders = [];

            foreach ($request->getHeaders() as $k => $vs) {
                foreach ($vs as $v) {
                    $requestHeaders[] = "$k: $v";
                }
            }

            $uri = $request->getUri();
            $path = $uri->getPath();

            if ($query = $uri->getQuery()) {
                $path .= '?'.$query;
            }

            print_r(sprintf(
                "Request %s\n%s %s HTTP/%s\r\n%s\r\n\r\n%s\r\n--------------------\r\n",
                $uri,
                $request->getMethod(),
                $path,
                $request->getProtocolVersion(),
                join("\r\n", $requestHeaders),
                $requestBody->getContents()
            ));

            return $request;
        }));
        $this->client = new Client(["base_uri" => $url, 'handler' => $stack]);
        $this->profile = $profile;
    }

    private function getOptions()
    {
        $options = ["allow_redirects" => false];
        $options["timeout"] = $this->profile->getHttpProfile()->getReqTimeout();
        $options["proxy"] = $this->profile->getHttpProfile()->getProxy();
        return $options;
    }

    public function getRequest($uri = '', $query = [], $headers = [])
    {
        $options = $this->getOptions();

        if ($query) {
            $options["query"] = $query;
        }

        if ($headers) {
            $options["headers"] = $headers;
        }
        return $this->client->get($uri, $options);
    }

    public function postRequest($uri = '', $headers = [], $body = '')
    {
        $options = $this->getOptions();
        if ($headers) {
            $options["headers"] = $headers;
        }

        if ($body) {
            $options["form_params"] = $body;
        }
        return $this->client->post($uri, $options);
    }

    public function postRequestRaw($uri = '', $headers = [], $body = '')
    {
        $options = $this->getOptions();
        if ($headers) {
            $options["headers"] = $headers;
        }

        if ($body) {
            $options["body"] = json_encode($body, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
//            $options["headers"]["Content-Length"] = strlen($options["body"]);
        }
        return $this->client->post($uri, $options);
    }
}