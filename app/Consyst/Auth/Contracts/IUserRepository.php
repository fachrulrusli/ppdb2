<?php
namespace App\Consyst\Auth\Contracts;
/**
 * interface IUserRepository
 *
 * @version 1.0
 * @author Hardiyansyah
 * @package Consyst\Auth\Contracts
 */
interface IUserRepository
{
    public function getAuthPassword();

    public function doLogin();

    public function doLogout();

    public function getPermissions();

    public function changeStatus($id, $value);

    public function showData();

    public function getreference();

    public function getGroups($id);

    public function UpdateX($data, $group, $id);

    public function getPerm();

    public function getPermById($id);

    public function storePerm($id, $perm);

    public function getMenu();

    public function getMenuById($id);

    public function storeMenus($id, $menus);

    public function getMainMenu($id);

    public function getChildMenu($id, $gid);


}
