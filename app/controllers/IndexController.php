<?php
/**
* IndexController for my_framework
* PHP version 5
*
* @category Controller
* @package  Pas_Pasckage
* @author   Loyer Kevin <kevin.loyer@epitech.eu>
* @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
* @link     http://www.zelda.com
*/
namespace app\controllers;
use lib\pada\Controller;
use app\models\UserTable;
/**
* IndexController for my_framework
* PHP version 5
*
* @category Controller
* @package  Pas_Pasckage
* @author   Loyer Kevin <kevin.loyer@epitech.eu>
* @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
* @link     http://www.zelda.com
*/
class IndexController extends Controller
{
    /**
    * IndexAction for my_framework
    *
    * @param string $pageView Title
    *
    * @return array $user Return
    */
    public function indexAction($pageView)
    {

        $userTable = new UserTable();
        $user = $userTable->findOne('login = ?, firstname = ?, lastname = ?', array('toto', 'Prenom', 'Nom'));

        $this->render($pageView, $user);
    }
}
?>