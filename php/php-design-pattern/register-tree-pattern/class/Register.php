<?php
class Register
{
    private static $container = array();

    /**
     * 通过别名获取对象
     * @date    2015-03-14
     * @param   string  $alias  别名
     * @return  获得的对象
     */
    public static function get($alias)
    {
        if ($is_valid = static::isValid($alias)) {
            return static::$container[$alias];
        } else {
            return $is_valid;
        }
    }

    /**
     * 通过别名注册对象
     * @date    2015-03-14
     * @param   string  $alias  别名
     * @param   object  $object  要注册的对象
     */
    public static function set($alias, $object)
    {
        if (!empty($alias) && !empty($object) && is_object($object)) {
            static::$container[$alias] = $object;
        }

    }

    /**
     * 通过别名销毁该对象
     * @date    2015-03-14
     * @param   string  $alias  别名
     */
    public static function unsetObject($alias) {
        if (static::isValid($alias)) {
            unset(static::$container[$alias]);
        }
    }

    /**
     * 判断别名是否已经注册
     * @date    2015-03-14
     * @param   string  $alias  别名
     * @return  boolean
     */
    public static function isValid($alias)
    {
        return array_key_exists($alias, self::$container);
    }
}
