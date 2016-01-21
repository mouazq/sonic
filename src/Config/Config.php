<?php namespace sgoendoer\Sonic\Config;

/**
 * Config
 * version 20160121
 *
 * author: Sebastian Goendoer
 * copyright: Sebastian Goendoer <sebastian.goendoer@rwth-aachen.de>
 */
class Config
{
	private static $_instance = NULL;
	
	private $primaryGSLSNode;
	private $secondaryGSLSNode;
	private $APIPath;
	private $timezone;
	
	public function __construct(ConfigBuilder $builder)
	{
		$this->primaryGSLSNode = $builder->getPrimaryGSLSNode();
		$this->secondaryGSLSNode = $builder->getSecondaryGSLSNode();
		$this->timezone = $builder->getTimezone();
		$this->APIPath = $builder->getAPIPath();
	}
	
	public static function getPrimaryGSLSNode()
	{
		return Config::getInstance()->primaryGSLSNode;
	}
	
	public function setPrimaryGSLSNode($ipAddress)
	{
		$this->primaryGSLSNode = $ipAddress;
		return $this;
	}
	
	public static function getSecondaryGSLSNode()
	{
		return Config::getInstance()->GSLSAddress;
	}
	
	public function setSecondaryGSLSNode($ipAddress)
	{
		$this->SecondaryGSLSNode = $ipAddress;
		return $this;
	}
	
	public static function getAPIPath()
	{
		return Config::getInstance()->APIPath;
	}
	
	public function setAPIPath($path)
	{
		$this->APIPath = $path;
		return $this;
	}
	
	public static function getTimezone()
	{
		return Config::getInstance()->APIPath;
	}
	
	public function setTimezone($tz)
	{
		$this->timezone = $tz;
		return $this;
	}
}

?>