<?php

namespace models;

/**
 * models\CiSessions
 */
class CiSessions
{
    /**
     * @var string $sessionId
     */
    private $sessionId;

    /**
     * @var string $ipAddress
     */
    private $ipAddress;

    /**
     * @var string $userAgent
     */
    private $userAgent;

    /**
     * @var integer $lastActivity
     */
    private $lastActivity;

    /**
     * @var text $userData
     */
    private $userData;


    /**
     * Get sessionId
     *
     * @return	string $sessionId
     */
    public function getSessionId()
    {
        return $this->sessionId;
    }

    /**
     * Set ipAddress
     *
     * @param	string 	$ipAddress
     * @return	models\CiSessions
     */
    public function setIpAddress($ipAddress)
    {
        $this->ipAddress = $ipAddress;
        return $this;
    }

    /**
     * Get ipAddress
     *
     * @return	string $ipAddress
     */
    public function getIpAddress()
    {
        return $this->ipAddress;
    }

    /**
     * Set userAgent
     *
     * @param	string 	$userAgent
     * @return	models\CiSessions
     */
    public function setUserAgent($userAgent)
    {
        $this->userAgent = $userAgent;
        return $this;
    }

    /**
     * Get userAgent
     *
     * @return	string $userAgent
     */
    public function getUserAgent()
    {
        return $this->userAgent;
    }

    /**
     * Set lastActivity
     *
     * @param	integer 	$lastActivity
     * @return	models\CiSessions
     */
    public function setLastActivity($lastActivity)
    {
        $this->lastActivity = $lastActivity;
        return $this;
    }

    /**
     * Get lastActivity
     *
     * @return	integer $lastActivity
     */
    public function getLastActivity()
    {
        return $this->lastActivity;
    }

    /**
     * Set userData
     *
     * @param	text 	$userData
     * @return	models\CiSessions
     */
    public function setUserData($userData)
    {
        $this->userData = $userData;
        return $this;
    }

    /**
     * Get userData
     *
     * @return	text $userData
     */
    public function getUserData()
    {
        return $this->userData;
    }
}