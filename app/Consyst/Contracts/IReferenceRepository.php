<?php 
namespace App\Consyst\Contracts;
/**
 * IReferenceRepository Interface
 *
 *
 * @version 1.0
 * @author Hardiyansyah
 * @package ksusb\consyst\Contracts
 */
interface IReferenceRepository
{
	public function changeStatus($id,$value);
	public function showData();
	public function getreference();
}
