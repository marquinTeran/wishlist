<?php

namespace models;


/**
 * CiSessions
 *
 * @Table(name="ci_sessions")
 * @Entity
 */
class CiSessions
{
    /**
     * @var string $sessionId
     *
     * @Column(name="session_id", type="string", length=40, nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    protected $sessionId;

    /**
     * @var string $ipAddress
     *
     * @Column(name="ip_address", type="string", length=16, nullable=false)
     */
    protected $ipAddress;

    /**
     * @var string $userAgent
     *
     * @Column(name="user_agent", type="string", length=50, nullable=false)
     */
    protected $userAgent;

    /**
     * @var integer $lastActivity
     *
     * @Column(name="last_activity", type="integer", nullable=false)
     */
    protected $lastActivity;

    /**
     * @var text $userData
     *
     * @Column(name="user_data", type="text", nullable=false)
     */
    protected $userData;

}
