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
 * @package     Axis_ShippingFlat
 * @subpackage  Axis_ShippingFlat_Model
 * @copyright   Copyright 2008-2011 Axis
 * @license     GNU Public License V3.0
 */

/**
 *
 * @category    Axis
 * @package     Axis_ShippingFlat
 * @subpackage  Axis_ShippingFlat_Model
 * @author      Axis Core Team <core@axiscommerce.com>
 */
class Axis_ShippingFlat_Model_Standard_MultiPrice implements Axis_Config_Option_Encodable_Interface
{
    /**
     *
     * @static
     * @param mixed
     * @return array
     */
    public static function encodeConfigOptionValue($params)
    {
        if (is_array($params)) {
            $temp = array();
            foreach ($params as $param) {
                $temp[$param['subcode']] = array(
                    'title'         => $param['title'],
                    'price'         => $param['price'],
                    'minOrderTotal' => $param['minOrderTotal'],
                    'maxOrderTotal' => $param['maxOrderTotal']
                );
            }
            $params = $temp;
        }
        return json_encode($params);
    }

    /**
     *
     * @static
     * @param string $value
     * @return string
     */
    public static function decodeConfigOptionValue($value)
    {
        return json_decode($value, true);
    }
}