<?php
namespace Kregel\Identicon\Facades;
use Illuminate\Support\Facades\Facade;
/**
 * Get the registered name of the component.
 *
 * @return string
 */
class Identicon extends Facade
{
	public static function getFacadeAccessor(){ return 'identicon'; }
}