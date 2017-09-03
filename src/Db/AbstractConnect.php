<?php

namespace Swoft\Db;

/**
 *
 *
 * @uses      AbstractConnect
 * @version   2017年09月01日
 * @author    stelin <phpcrazy@126.com>
 * @copyright Copyright 2010-2016 swoft software
 * @license   PHP Version 7.x {@link http://www.php.net/license/3_0.txt}
 */
abstract class AbstractConnect implements IConnect
{
    /**
     * 驱动类型
     *
     * @var string
     */
    protected $driver;

    public function __construct(string $driver)
    {
        $this->driver = $driver;
    }

    /**
     * @return string
     */
    public function getDriver(): string
    {
        return $this->driver;
    }
}