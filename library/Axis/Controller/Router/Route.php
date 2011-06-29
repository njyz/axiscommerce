<?php
/**
 * Axis
 *
 * This file is part of Axis.
 *
 * Axis is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Axis is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Axis.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @category    Axis
 * @package     Axis_Controller
 * @subpackage  Axis_Controller_Router
 * @copyright   Copyright 2008-2011 Axis
 * @copyright   Dmitry Merva  http://myengine.com.ua  d.merva@gmail.com
 * @license     GNU Public License V3.0
 */

/**
 *
 * @category    Axis
 * @package     Axis_Controller
 * @subpackage  Axis_Controller_Router
 * @author      Axis Core Team <core@axiscommerce.com>
 */
class Axis_Controller_Router_Route extends Zend_Controller_Router_Route
{
    /**
     *
     * @static
     * @var array
     */
    protected static $_locales = array('en', 'ru');

    /**
     *
     * @static
     * @var string
     */
    protected static $_defaultLocale = 'en';

    /**
     *
     * @static
     * @var bool
     */
    private static $_hasLocaleInUrl = false;

    /**
     *
     * @var string
     */
    private static $_currentLocale = 'en';

    /**
     *
     * @static
     * @param array $locales
     */
    public static function setLocales(array $locales)
    {
        self::$_locales = $locales;
    }

    /**
     *
     * @static
     * @param string $locale[optional]
     */
    public static function setDefaultLocale($locale = null)
    {
        self::$_defaultLocale = $locale;
    }

    /**
     * Matches a user submitted path with parts defined by a map. Assigns and
     * returns an array of variables on a successful match.
     *
     * @param string $path Path used to match against this routing map
     * @return array|false An array of assigned values or a false on a mismatch
     */
    public function match($path)
    {
        $path = trim($path, $this->_urlDelimiter);
        $pathParts = explode($this->_urlDelimiter, $path, 2);

        if(in_array($pathParts[0], self::$_locales)) {
            $path = (sizeof($pathParts) > 1) ? $pathParts[1] : '';
            $currentLocale = $pathParts[0];
            self::$_hasLocaleInUrl = true;
        } else {
            if(isset($this->_defaults['locale'])) {
                $currentLocale = $this->_defaults['locale'];
            } else {
                $currentLocale = self::$_defaultLocale;
            }
        }

        self::$_currentLocale = $currentLocale;

        $params = parent::match($path);

        if($params) {
            $params = array_merge($params, array('locale' => $currentLocale));
        }

        return $params;
    }

    /**
     *
     * @return bool
     */
    public static function hasLocaleInUrl()
    {
        return self::$_hasLocaleInUrl;
    }

    /**
     *
     * @return string
     */
    public static function getCurrentLocale()
    {
        return self::$_currentLocale;
    }

    /**
     * Assembles user submitted parameters forming a URL path defined by this route
     *
     * @param  array $data An array of variable and value pairs used as parameters
     * @param  boolean $reset Whether or not to set route defaults with those provided in $data
     * @return string Route path with user submitted parameters
     */
    public function assemble($data = array(), $reset = false, $encode = false)
    {
        if(!isset($data['locale'])) {
            return parent::assemble($data, $reset, $encode);
        }
        $locale = $data['locale'];
        unset($data['locale']);
        $assemble = parent::assemble($data, $reset, $encode);
        if(in_array($locale, self::$_locales)) {
            if(isset($this->_defaults['locale'])) {
                $defaultLocale = $this->_defaults['locale'];
            } else {
                $defaultLocale = self::$_defaultLocale;
            }

            if($locale != $defaultLocale) {
                $assemble = implode($this->_urlDelimiter, array($locale, $assemble));
            }
        }
        return $assemble;
    }
}