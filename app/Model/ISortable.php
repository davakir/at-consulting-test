<?php
/**
 * Created by PhpStorm.
 * User: daryakiryanova
 * Date: 25.02.2018
 * Time: 12:09
 */

namespace Model;


interface ISortable
{
	public function sort(array $data) : array;
}