<?php



/**
 * Groups
 *
 * @Table(name="groups")
 * @Entity
 */
class Groups
{
    /**
     * @var boolean $id
     *
     * @Column(name="id", type="smallint", nullable=false)
     * @Id
     * @GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $name
     *
     * @Column(name="name", type="string", length=16, nullable=false)
     */
    private $name;

    /**
     * @var smallint $level
     *
     * @Column(name="level", type="smallint", nullable=false)
     */
    private $level;

}