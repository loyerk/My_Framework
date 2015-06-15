<?php
/**
* Flux for FlouRss
* PHP version 5
*
* @category Controller
* @package  Pas_Pasckage
* @author   Loyer Kevin <kevin.loyer@epitech.eu>
* @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
* @link     http://www.zelda.com
*/
namespace lib\pada;
/**
* Flux for FlouRss
* PHP version 5
*
* @category Controller
* @package  Pas_Pasckage
* @author   Loyer Kevin <kevin.loyer@epitech.eu>
* @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
* @link     http://www.zelda.com
*/
abstract class Controller
{
    /**
    * Render for my_framework
    *
    * @param string $pageView pageView
    * @param string $array    array
    *
    * @return string $read     Return
    */
    public function render($pageView, $array = array())
    {
        $paramTab = explode(":", $pageView);

        $controller = $paramTab[0];
        $view = $paramTab[1];

        if (file_exists(dirname(__FILE__).DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."app".DIRECTORY_SEPARATOR."views".DIRECTORY_SEPARATOR.$controller.DIRECTORY_SEPARATOR.$view.".php")) {
            $view = $view.".php";
        }
        if (file_exists(dirname(__FILE__).DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."app".DIRECTORY_SEPARATOR."views".DIRECTORY_SEPARATOR.$controller.DIRECTORY_SEPARATOR.$view.".html")) {
            $view = $view.".html";
        }
        if (file_exists(dirname(__FILE__).DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."app".DIRECTORY_SEPARATOR."views".DIRECTORY_SEPARATOR.$controller.DIRECTORY_SEPARATOR.$view.".phtml")) {
            $view = $view.".phtml";
        }

        $pageView = dirname(__FILE__).DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."app".DIRECTORY_SEPARATOR."views".DIRECTORY_SEPARATOR.$controller.DIRECTORY_SEPARATOR.$view;

        $html = fopen($pageView, "r+");
        $size = filesize($pageView);
        $read = fread($html, $size);

        if (!empty($array)) {

            foreach ($array as $key => $value) {

                $read = str_replace('{{ '.$key.' }}', $value, $read);
            }
        }

        echo $read;
    }
}
?>
