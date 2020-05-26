<?php
namespace App\Consyst\Auth\Contracts;
/**
 * IGrupRepository Interface
 *
 *
 * @version 1.0
 * @author Hardiyansyah
 * @package Consyst\Auth\Contracts
 */
interface IGrupRepository
{
    public function changeStatus($id, $value);

    public function getPerm();

    public function getPermById($id);

    public function storePerm($id, $perm);

    public function getMenu();

    public function getMenuById($id);

    public function storeMenus($id, $menus);

}
