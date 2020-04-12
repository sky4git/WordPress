<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ILAB\MediaCloud\Utilities\Misc\Symfony\Component\Config\Resource;

/**
 * ClassExistenceResource represents a class existence.
 * Freshness is only evaluated against resource existence.
 *
 * The resource must be a fully-qualified class name.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class ClassExistenceResource implements \ILAB\MediaCloud\Utilities\Misc\Symfony\Component\Config\Resource\SelfCheckingResourceInterface, \Serializable
{
    private $resource;
    private $exists;
    private static $autoloadLevel = 0;
    private static $autoloadedClass;
    private static $existsCache = [];
    /**
     * @param string    $resource The fully-qualified class name
     * @param bool|null $exists   Boolean when the existency check has already been done
     */
    public function __construct($resource, $exists = null)
    {
        $this->resource = $resource;
        if (null !== $exists) {
            $this->exists = (bool) $exists;
        }
    }
    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return $this->resource;
    }
    /**
     * @return string The file path to the resource
     */
    public function getResource()
    {
        return $this->resource;
    }
    /**
     * {@inheritdoc}
     *
     * @throws \ReflectionException when a parent class/interface/trait is not found
     */
    public function isFresh($timestamp)
    {
        $loaded = \class_exists($this->resource, \false) || \interface_exists($this->resource, \false) || \trait_exists($this->resource, \false);
        if (null !== ($exists =& self::$existsCache[(int) (0 >= $timestamp)][$this->resource])) {
            $exists = $exists || $loaded;
        } elseif (!($exists = $loaded)) {
            if (!self::$autoloadLevel++) {
                \spl_autoload_register(__CLASS__ . '::throwOnRequiredClass');
            }
            $autoloadedClass = self::$autoloadedClass;
            self::$autoloadedClass = \ltrim($this->resource, '\\');
            try {
                $exists = \class_exists($this->resource) || \interface_exists($this->resource, \false) || \trait_exists($this->resource, \false);
            } catch (\Exception $e) {
                try {
                    self::throwOnRequiredClass($this->resource, $e);
                } catch (\ReflectionException $e) {
                    if (0 >= $timestamp) {
                        unset(self::$existsCache[1][$this->resource]);
                        throw $e;
                    }
                }
            } finally {
                self::$autoloadedClass = $autoloadedClass;
                if (!--self::$autoloadLevel) {
                    \spl_autoload_unregister(__CLASS__ . '::throwOnRequiredClass');
                }
            }
        }
        if (null === $this->exists) {
            $this->exists = $exists;
        }
        return $this->exists xor !$exists;
    }
    /**
     * @internal
     */
    public function serialize()
    {
        if (null === $this->exists) {
            $this->isFresh(0);
        }
        return \serialize([$this->resource, $this->exists]);
    }
    /**
     * @internal
     */
    public function unserialize($serialized)
    {
        list($this->resource, $this->exists) = \unserialize($serialized);
    }
    /**
     * Throws a reflection exception when the passed class does not exist but is required.
     *
     * A class is considered "not required" when it's loaded as part of a "class_exists" or similar check.
     *
     * This function can be used as an autoload function to throw a reflection
     * exception if the class was not found by previous autoload functions.
     *
     * A previous exception can be passed. In this case, the class is considered as being
     * required totally, so if it doesn't exist, a reflection exception is always thrown.
     * If it exists, the previous exception is rethrown.
     *
     * @throws \ReflectionException
     *
     * @internal
     */
    public static function throwOnRequiredClass($class, \Exception $previous = null)
    {
        // If the passed class is the resource being checked, we shouldn't throw.
        if (null === $previous && self::$autoloadedClass === $class) {
            return;
        }
        if (\class_exists($class, \false) || \interface_exists($class, \false) || \trait_exists($class, \false)) {
            if (null !== $previous) {
                throw $previous;
            }
            return;
        }
        if ($previous instanceof \ReflectionException) {
            throw $previous;
        }
        $e = new \ReflectionException(\sprintf('Class "%s" not found while loading "%s".', $class, self::$autoloadedClass), 0, $previous);
        if (null !== $previous) {
            throw $e;
        }
        $trace = \debug_backtrace();
        $autoloadFrame = ['function' => 'spl_autoload_call', 'args' => [$class]];
        if (\false === ($i = \array_search($autoloadFrame, $trace, \true))) {
            throw $e;
        }
        if (isset($trace[++$i]['function']) && !isset($trace[$i]['class'])) {
            switch ($trace[$i]['function']) {
                case 'get_class_methods':
                case 'get_class_vars':
                case 'get_parent_class':
                case 'is_a':
                case 'is_subclass_of':
                case 'class_exists':
                case 'class_implements':
                case 'class_parents':
                case 'trait_exists':
                case 'defined':
                case 'interface_exists':
                case 'method_exists':
                case 'property_exists':
                case 'is_callable':
                    return;
            }
            $props = ['file' => isset($trace[$i]['file']) ? $trace[$i]['file'] : null, 'line' => isset($trace[$i]['line']) ? $trace[$i]['line'] : null, 'trace' => \array_slice($trace, 1 + $i)];
            foreach ($props as $p => $v) {
                if (null !== $v) {
                    $r = new \ReflectionProperty('Exception', $p);
                    $r->setAccessible(\true);
                    $r->setValue($e, $v);
                }
            }
        }
        throw $e;
    }
}
