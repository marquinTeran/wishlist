<?php

namespace models;


/**
 * PopularProduct
 *
 * @Table(name="popular_product")
 * @Entity
 */
class PopularProduct extends TimestampedModel
{
	/**
	 * @var	integer	$id
	 *
	 * @Id
	 * @Column(type="integer", nullable=false)
	 * @GeneratedValue(strategy="AUTO")
	 */
	protected $id;

    /**
     * @var string $title
     *
     * @Column(name="title", type="string", length=127, nullable=false, unique=true)
     */
    protected $title;

    /**
     * @var string $image_url
     *
     * @Column(name="image_url", type="string", length=127, nullable=true)
     */
    protected $image_url;

    /**
     * @var float $price_range_min
     *
     * @Column(name="price_range_min", type="decimal", precision=8, scale=2, nullable=true)
     */
    protected $price_range_min;

    /**
     * @var float $price_range_max
     *
     * @Column(name="price_range_max", type="decimal", precision=8, scale=2, nullable=true)
     */
    protected $price_range_max;

}
