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
use lib\pada\exceptions\NotFoundException;
use Exception;

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
class Core
{
    /**
    * Run for my_framework
    *
    * @return string $NotFoundException Return
    */
    public static function run()
    {

        spl_autoload_register(array(__CLASS__, 'registerAutoload'));

        try
        {
            if (isset($_GET['page'])) {

                if (is_file("../app/controllers/".urldecode($_GET['page'])."Controller.php")) {

                    $pageController = ucwords($_GET['page'])."Controller.php";
                    include "../app/controllers/". $pageController;

                    $controller = "app\\controllers\\" . ucwords($_GET['page'])."Controller";

                    $objet = new $controller;

                    $params = explode("/", $_GET['legion']);

                    if (isset($params[1])) {

                        $pageView = ucwords($_GET['page'])."Controller:".strtolower($params[1]);

                        $controllerAction = $_GET['legion'];
                        $actions = explode("/", $controllerAction);
                        $controllerAction = $actions[1]."Action";

                        if (method_exists($objet, $controllerAction)) {

                            $objet->$controllerAction($pageView);

                        } else {

                            throw new NotFoundException();
                        }
                    }

                } elseif ($_GET['page'] === "") {

                    include dirname(__FILE__)."/../../app/controllers/IndexController.php";

                } else {

                    throw new NotFoundException();
                }

            } else {

                throw new NotFoundException();
            }
        }
        catch(Exception $e)
        {
            if ($e instanceof NotFoundException) {

                header('HTTP/1.1 404 Not Found');
                include dirname(__FILE__)."/../../app/views/error.php";

            } else {

                header('HTTP/1.1 500 Internal Server Error');
                include dirname(__FILE__)."/../../app/views/error.php";
            }
        }
    }
    /**
    * RegisterAutoload for my_framework
    *
    * @param string $className className
    *
    * @return string $fileName Include
    */
    public static function registerAutoload($className)
    {

        $folder = explode('\\', $className);

        if ($folder[0] === "lib" && $folder[2] !== "PDO") {
            unset($folder[0]);
            unset($folder[1]);
            $chemin = implode('/', $folder);
            $fileName = '/' .$chemin.".php";
        } elseif ($folder[0] === "app" && $folder[1] === "controllers" && $folder[2] !== "PDO") {

            $fileName = dirname(__FILE__).DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."lib".DIRECTORY_SEPARATOR."pada".DIRECTORY_SEPARATOR.$folder[2].".php";
        } elseif ($folder[0] === "app" && $folder[1] === "models" && $folder[2] !== "PDO") {

            $fileName = dirname(__FILE__).DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."app".DIRECTORY_SEPARATOR."models".DIRECTORY_SEPARATOR.$folder[2].".php";
        }
        if (isset($fileName)) {

            include_once $fileName;
        }
    }
}
?>
