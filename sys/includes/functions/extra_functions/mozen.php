<?php
/**
 * Mozen - Responsive Zencart Template
 *
 * @package mozen-admin
 * @author Mojoomla <sales@mojoomla.com> 
 * @author website www.mojoomla.com
 * @copyright Copyright 2012-2013 Das Infomedia
 * @license http://www.gnu.org/copyleft/gpl.html   GNU Public License V2.0
 * @version $Id: mozen.php 1.0 2012-10-10 11:50:04Z $ 
 */

if (!defined('IS_ADMIN_FLAG')) {
    die('Illegal Access');
}

if (function_exists('zen_register_admin_page')) {
    if (!zen_page_key_exists('mozen')) {
        // Add Color menu to Tools menu
        zen_register_admin_page('mozen', 'BOX_TOOLS_MOZEN','FILENAME_MOZEN', '', 'tools', 'Y', 20);
    }
}
?>