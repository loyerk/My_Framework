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
namespace app\models;
use lib\pada\Model;
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
class UserTable extends Model
{
    /**
    * IndexAction for my_framework
    *
    * @param string $where        Where
    * @param string $placeHolders PlaceHolders
    *
    * @return array $tab Return
    */
    public function findOne($where, $placeHolders)
    {

        $countIntero = substr_count($where, '?');

        if ($countIntero === count($placeHolders)) {

            $classTable = __CLASS__;
            $classTable = preg_split('/(?=[A-Z])/', $classTable);
            $table = strtolower($classTable[1]);

            $condition = explode(',', $where);

            $where = str_replace(', ', ' AND ', $where);

            $req = self::$pdo->prepare('SELECT * FROM '.$table.' WHERE '.$where);

            for ($i = 0; $i < $countIntero; $i = $i + 1) {

                $req->bindValue($i + 1, $placeHolders[$i]);
            }

            $req->execute();
            $tab = $req->fetch();

            return $tab;

        } else {

            echo "+ de ? que de machin";
        }
    }
}
?>