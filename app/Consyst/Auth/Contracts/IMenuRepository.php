<?php
namespace App\Consyst\Auth\Contracts;
/**
 * IMenuRepository short summary.
 *
 * IMenuRepository description.
 *
 * @version 1.0
 * @author Hardiyansyah
 * @package Consyst\Auth\Contracts
 */
interface IMenuRepository
{
    public function loadMenu($uid, $grpid);

    public function getChild();

    public function showData();

    public function changeStatus($id, $value);

    public function walk_recursive_remove(array $array, callable $callback);

    public function doFilter($value, $key);

    public function loadMenuMultiGroup($uid, $grpid);

    public function getMenu();


}
