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
 * @package     Axis_Tax
 * @subpackage  Axis_Tax_Model
 * @copyright   Copyright 2008-2012 Axis
 * @license     GNU Public License V3.0
 */

/**
 * @category    Axis
 * @package     Axis_Tax
 * @subpackage  Axis_Tax_Model
 * @author      Axis Core Team <core@axiscommerce.com>
 */
class Axis_Tax_Model_Observer
{
    public function prepareAdminNavigationBox(Axis_Admin_Box_Navigation $box)
    {
        $box->addItem(array(
            'location' => array(
                'pages' => array(
                    'tax/class' => array(
                        'label'         => 'Tax Classes',
                        'order'         => 40,
                        'translator'    => 'Axis_Tax',
                        'module'        => 'Axis_Tax',
                        'controller'    => 'class',
                        'route'         => 'admin/axis/tax',
                        'resource'      => 'admin/axis/tax/class/index'
                    ),
                    'tax/rate' => array(
                        'label'         => 'Tax Rates',
                        'order'         => 50,
                        'translator'    => 'Axis_Tax',
                        'module'        => 'Axis_Tax',
                        'controller'    => 'rate',
                        'route'         => 'admin/axis/tax',
                        'resource'      => 'admin/axis/tax/rate/index'
                    )
                )
            )
        ));
    }
}
