<?php

namespace swoft\helpers;

use DI\Container;
use swoft\web\Application;

/**
 *
 *
 * @uses      BeanFactory
 * @version   2017年04月25日
 * @author    lilin <lilin@ugirls.com>
 * @copyright Copyright 2010-2016 北京尤果网文化传媒有限公司
 * @license   PHP Version 5.x {@link http://www.php.net/license/3_0.txt}
 */
class BeanFactory
{
    /**
     * @var Container
     */
    private static $container;


    /**
     * create beans by type
     *
     * below are some examples:
     *
     * // create with class name
     * BeanFactory::BeanFactory('\swoft\web\UrlManage');
     *
     * // crreate with class configures
     * BeanFactory::BeanFactory(
     *  [
     *      'class' => '\swoft\web\UrlManage',
     *      'field' => 'value1',
     *      'field2' => 'value'2
     *  ]
     * );
     *
     * @param string       $beanName    the name of bean
     * @param array|string $type        class definition
     * @param array        $params      constructor parameters
     * @return Object
     */
    public static function createBean($beanName, $type, $params = [])
    {
        $fields = [];
        $className = $type;
        if(is_array($type)){
            if(isset($type['class'])){
                $className = $type['class'];
            }else{
                $className = Application::class;
            }
            unset($type['class']);
            $fields = $type;
        }
        $object = \DI\object($className);
        $object = $object->constructor($params);
        foreach ($fields as $name => $value){
            $object = $object->property($name, $value);
        }
        $object = $object->method('init');
        self::$container->set($beanName, $object);

        return self::$container->get($beanName);
    }
    /**
     *
     * @param $name
     *
     * @return mixed
     */
    public static function getBean($name)
    {
        return self::$container->get($name);
    }

    /**
     * @return Container
     */
    public static function getContainer()
    {
        return self::$container;
    }

    /**
     * whether contain a bean by name
     *
     * @param string $name
     * @return bool
     */
    public static function containsBean($name)
    {
        return self::$container->has($name);
    }

    /**
     * @param Container $container
     */
    public static function setContainer($container)
    {
        self::$container = $container;
    }
}