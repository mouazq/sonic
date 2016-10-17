<?php namespace sgoendoer\Sonic\Model;

use sgoendoer\Sonic\Date\XSDDateTime;
use sgoendoer\Sonic\Identity\GID;
use sgoendoer\Sonic\Identity\UOID;
use sgoendoer\Sonic\Model\IllegalModelStateException;
use sgoendoer\Sonic\Model\ReferencingObjectBuilder;
use sgoendoer\Sonic\Model\ContentAccessControlObject;

/**
 * Builder class for a ContentAccessControlRule object
 * version 20151017
 *
 * author: Sebastian Goendoer
 * copyright: Sebastian Goendoer <sebastian.goendoer@rwth-aachen.de>
 */
class ContentAccessControlRuleObjectBuilder extends ReferencingObjectBuilder
{
	protected $owner				= NULL;
	protected $index				= 0;
	protected $directive			= NULL;
	protected $scope				= NULL;
	protected $accessList			= array();
	
	public static function buildFromJSON($json)
	{
		// TODO parse and verify json
		$jsonObject = json_decode($json);
		
		$builder = (new ContentAccessControlRuleObjectBuilder())
					->objectID($jsonObject->objectID)
					->targetID($jsonObject->targetID)
					->owner($jsonObject->owner)
					->index($jsonObject->index)
					->directive($jsonObject->directive)
					->scope($jsonObject->scope);
					
		$accessList = array();
		
		foreach($jsonObject->accessList as $member)
			$accessList[] = $member;
		
		if(is_array($accessList))
			asort($accessList);
		
		$builder->allow($accessList);
		
		return $builder->build();
	}
	
	public function getOwner()
	{
		return $this->owner;
	}
	
	public function owner($owner)
	{
		$this->owner = $owner;
		return $this;
	}
	
	public function getIndex()
	{
		return $this->index;
	}
	
	public function index($index)
	{
		$this->index = $index;
		return $this;
	}
	
	public function getScope()
	{
		return $this->scope;
	}
	
	public function scope($scope)
	{
		$this->scope = $scope;
		return $this;
	}
	
	public function getDirective()
	{
		return $this->directive;
	}
	
	public function directive($directive)
	{
		$this->directive = $directive;
		return $this;
	}
	
	public function getAccessList()
	{
		return $this->accessList;
	}
	
	public function accessList($accessList)
	{
		$this->accessList = $accessList;
		asort($this->accessList);
		return $this;
	}
	
	public function build()
	{
		if($this->objectID == NULL)
			$this->objectID = UOID::createUOID();
		if($this->accessList == NULL)
			$this->accessList = array();
		if($this->index == NULL)
			$this->index = 0;
		
		if(!UOID::isValid($this->objectID))
			throw new IllegalModelStateException('Invalid objectID');
		if(!UOID::isValid($this->targetID))
			throw new IllegalModelStateException('Invalid targetID');
		if(!is_numeric($this->index))
			throw new IllegalModelStateException('Invalid index value');
		if(!is_array($this->accessList))
			throw new IllegalModelStateException('Invalid accessList');
		
		if($this->directive != ContentAccessControlRuleObject::ACL_DIRECTIVE_DENY 
			&& $this->directive != ContentAccessControlRuleObject::ACL_DIRECTIVE_ALLOW)
			throw new IllegalModelStateException('Invalid directive');
		
		if($this->scope != ContentAccessControlRuleObject::ACL_SCOPE_FRIENDS 
			&& $this->scope != ContentAccessControlRuleObject::ACL_SCOPE_ALL 
			&& $this->scope != ContentAccessControlRuleObject::ACL_SCOPE_GROUP 
			&& $this->scope != ContentAccessControlRuleObject::ACL_SCOPE_INDIVIDUAL)
			throw new IllegalModelStateException('Invalid directive');
		
		return new ControlAccessControlRuleObject($this);
	}
}