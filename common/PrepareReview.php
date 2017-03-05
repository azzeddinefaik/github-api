<?php

class PrepareReview
{

    protected $body;
    protected $pRnumber;
    protected $buildNumber;

    const LINTING_TITLE    = "<h3> PHP Linting ";
    const UNITTEST_TITLE   = "<h3> PHP UnitTest ";
    const CODESNIFF_TITLE  = "<h3> PHP Code Sniff ";
    const SUCCESS_HEADER   = " is successful </h3> ";
    const FAILURE_HEADER   = " is failed </h3> ";
    const ERROR_MESSAGE    = "<h5> Please check Syntax errors : </h5>";
    const BLOCKQUOTE_OPEN  = "<blockquote>";
    const BLOCKQUOTE_CLOSE = "</blockquote>";

    /**
     * @param bool $status
     * @param string $errors
     */
    public function prepareLintingBody($status = 1, $errors = "")
    {
        $header     = ($status == 1) ? self::SUCCESS_HEADER : self::FAILURE_HEADER;
        $errors     = (!empty($errors)) ? self::ERROR_MESSAGE . self::BLOCKQUOTE_OPEN . $errors . self::BLOCKQUOTE_CLOSE : "";
        $this->body = self::LINTING_TITLE . $this->buildNumber . $header . $errors;

        return $this;
    }

    /**
     * @param bool $status
     * @param string $errors
     */
    public function prepareUnitTestBody($status = 1, $errors = "")
    {
        $header     = ($status == 1) ? self::SUCCESS_HEADER : self::FAILURE_HEADER;
        $errors     = (!empty($errors)) ? self::ERROR_MESSAGE . self::BLOCKQUOTE_OPEN . $errors . self::BLOCKQUOTE_CLOSE : "";
        $this->body = self::UNITTEST_TITLE . $this->buildNumber . $header . $errors;

        return $this;
    }

    /**
     * @param bool $status
     * @param string $errors
     */
    public function prepareCodeSniffBody($status = 1, $errors = "")
    {
        $header     = ($status == 1) ? self::SUCCESS_HEADER : self::FAILURE_HEADER;
        $errors     = (!empty($errors)) ? self::ERROR_MESSAGE . $errors   : "";
        $this->body = self::CODESNIFF_TITLE . $this->buildNumber . $header ."```". $errors ."```";

        return $this;
    }


    public function getBody()
    {
        return $this->body;
    }

    /**
     * @return mixed
     */
    public function getPRnumber()
    {
        return $this->pRnumber;
    }

    /**
     * @param mixed $pRnumber
     */
    public function setPRnumber($pRnumber)
    {
        $this->pRnumber = $pRnumber;

        return $this;
    }


    /**
     * @return mixed
     */
    public function getBuildNumber()
    {
        return $this->buildNumber;
    }

    /**
     * @param mixed $buildNumber
     */
    public function setBuildNumber($buildNumber)
    {
        $this->buildNumber = $buildNumber;

        return $this;
    }

}