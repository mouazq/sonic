<?php namespace sgoendoer\Sonic\Request;

use sgoendoer\Sonic\Sonic;
use sgoendoer\Sonic\Config\Configuration;

class MalformedResponseHeaderException extends \Exception
{
	public function __construct($message = null, $code = 0, \Exception $previous = null)
	{
		parent::__construct($message, $code, $previous);
		
		if(Configuration::getVerbose() >= 1)
			Sonic::getLogger()->addError($message);
	}
}

?>