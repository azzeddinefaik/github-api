<?php
require_once __DIR__ . '/global.php';


/**
 * Class PRReviews
 * @desc this class is used to review prs
 */
class PRReviews
{

    /**
     * @var null
     */
    protected $apiToken = null;
    protected $client   = null;
    protected $baseUrl  = 'https://api.github.com';
    protected $repos    = null;

    protected $numder         = null;
    protected $action         = null;
    protected $requestTimeout = 15;
    protected $body           = null;


    public function __construct()
    {
        return $this;
    }


    /**
     * @return null
     */
    public function getApiToken()
    {
        return $this->apiToken;
    }

    /**
     * @param null $apiToken
     *
     * @return PRReviews
     */
    public function setApiToken($apiToken)
    {
        $this->apiToken = $apiToken;

        return $this;
    }

    /**
     * @return GuzzleHttp\Client;
     */
    public function getClient()
    {
        $this->setClient();

        return $this->client;
    }

    /**
     * @return GuzzleHttp\Client;
     */
    public function setClient()
    {
        if ($this->client instanceof GuzzleHttp\Client) {
            return $this->client;
        }

        return $this->client = $this->initClient();
    }

    /**
     * @return \GuzzleHttp\Client
     */
    public function initClient()
    {
        $client = new \GuzzleHttp\Client( [
            // Base URI is used with relative requests
            'base_uri' => $this->baseUrl,
            // You can set any number of default request options.
            'timeout'  => $this->requestTimeout,
            'verify'   => false,
        ] );

        return $client;
    }

    /**
     * @return null
     */
    public function getRepos()
    {
        return $this->repos;
    }

    /**
     * @param null $number
     *
     * @return PRReviews
     */
    public function setRepos($repos)
    {
        $this->repos = $repos;

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
     * @return PRReviews
     */
    public function setAction($action)
    {
        $this->action = $action;

        return $this;
    }

    /**
     * @return null
     */
    public function getNumder()
    {
        return $this->numder;
    }

    /**
     * @param null $numder
     */
    public function setNumder($numder)
    {
        $this->numder = $numder;

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
     * @param null $body
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function reviewPullRequest()
    {
        $response = $this->getClient()->request( 'POST', $this->baseUrl . "/repos/tajawal/" . $this->getRepos() . "/pulls/" . $this->getNumder() . "/reviews", [
            'headers' => [
                'Authorization' => 'Basic ' . $this->getApiToken(),
                'Accept'        => 'application/vnd.github.black-cat-preview+json',
            ],
            'json'    => [
                "body"  => $this->getBody(),
                "event" => $this->getAction(),
            ],
        ] );

        return $response;
    }

    /**
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function commentPullRequest()
    {
        $response = $this->getClient()->request( 'POST', $this->baseUrl . "/repos/tajawal/" . $this->getRepos() . "/pulls/" . $this->getNumder() . "/comments", [
            'headers' => [
                'Authorization' => 'Basic ' . $this->getApiToken(),
                'Accept'        => 'application/vnd.github.black-cat-preview+json',
            ],
            'json'    => [
                "body"  => $this->getBody(),
                "event" => $this->getAction(),
            ],
        ] );

        return $response;
    }

    /**
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function getUsersInfos($username = "azzeddine")
    {
        $response = $this->getClient()->request( 'GET', $this->baseUrl . "/users/".$username, [
            'headers' => [
                'Authorization' => 'Basic ' . $this->getApiToken(),
                'Accept'        => 'application/vnd.github.black-cat-preview+json',
            ],
        ] );

        return $response;
    }

}