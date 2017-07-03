<?php

namespace App;

use GuzzleHttp\Client;

/**
 * Class PRReviews
 *
 * @desc this class is used to review prs
 */
class GithubApi
{

    /**
     * @var null
     */
    protected $apiToken = null;

    /** @var \GuzzleHttp\Client */
    protected $client = null;

    protected $baseUrl        = 'https://api.github.com';
    protected $repos          = null;
    protected $action         = null;
    protected $requestTimeout = 15;
    protected $body           = null;
    protected $test           = null;
    


    /**
     * @return string
     */
    public function getApiToken(): string
    {
        return (string)$this->apiToken;
    }

    /**
     * @param string $apiToken
     *
     * @return $this
     */
    public function setApiToken(string $apiToken)
    {
        $this->apiToken = $apiToken;

        return $this;
    }

    /**
     * @return Client;
     */
    public function getClient()
    {
        $this->setClient();

        return $this->client;
    }

    /**
     * @return Client;
     */
    public function setClient()
    {
        if ($this->client instanceof Client) {
            return $this->client;
        }

        return $this->client = $this->initClient();
    }

    /**
     * @return Client
     */
    public function initClient()
    {
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => $this->getBaseUrl(),
            // You can set any number of default request options.
            'timeout'  => $this->requestTimeout,
            'verify'   => false,
        ]);

        return $client;
    }

    /**
     * @return string
     */
    public function getBaseUrl(): string
    {
        return (string)$this->baseUrl;
    }

    /**
     * @return array
     */
    public function getRepos(): array
    {
        return (array)$this->repos;
    }

    /**
     * @param array $repos
     *
     * @return $this
     */
    public function setRepos(array $repos)
    {
        $this->repos = (array)$repos;

        return $this;
    }

    /**
     * @return null
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param null $action
     *
     * @return GithubApi
     */
    public function setAction($action)
    {
        $this->action = $action;

        return $this;
    }


    /**
     * @return null
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param  $body
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * @param string $username
     *
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function getUsersInfo(string $username)
    {
        $response = $this->getClient()->request('GET', $this->baseUrl . "/users/" . $username, [
            'headers' => [
                'Authorization' => 'Basic ' . $this->getApiToken(),
                'Accept'        => 'application/vnd.github.black-cat-preview+json',
            ],
        ]);

        return $response;
    }

}
