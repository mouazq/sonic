<?php namespace sgoendoer\Sonic\Model;

use sgoendoer\Sonic\Date\XSDDateTime;
use sgoendoer\Sonic\Model\ReferencingRemoteObject;
use sgoendoer\Sonic\Model\TrustObjectBuilder;

/**
 * Represents a TRUST object
 * version 20160413
 *
 * author: Mouaz Al Qudsi
 */
class TrustObject extends ReferencingRemoteObject implements IAccessRestrictableObject
{
	const JSONLD_CONTEXT = 'http://sonic-project.net/';
	const JSONLD_TYPE = 'trust';

	protected $author = NULL;
	protected $datePublished = NULL;
	protected $targetGID = NULL;

	public function __construct(TrustObjectBuilder $builder)
	{
		parent::__construct($builder->getObjectID(), $builder->getTargetGID());
		$this->targetGID = $builder->getTargetGID();
		$this->author = $builder->getAuthor();
		$this->datePublished = $builder->getDatePublished();
		$this->signature = $builder->getSignature();
	}

	public function getAuthor()
	{
		return $this->author;
	}

	public function setAuthor($author)
	{
		$this->author = $author;
		return $this;
	}

	public function getDatePublished()
	{
		return $this->datePublished;
	}

	public function setDatePublished($datePublished)
	{
		if($datePublished == NULL)
			$this->datePublished = XSDDateTime::getXSDDateTime();
		else
			$this->datePublished = $datePublished;
		return $this;
	}


  public function getTargetGID()
	{
		$this->targetGID;
	}

	public function setTargetGID($targetGID)
	{
		$this->targetGID = $targetGID;
		$this->invalidate();

		return $this;
	}

	public function getJSONString()
	{
		$json =  '{'
			. '"@context":"' . TrustObject::JSONLD_CONTEXT . '",'
			. '"@type":"' . TrustObject::JSONLD_TYPE . '",'
			. '"objectID":"' . $this->objectID . '",'
			. '"targetGID":"' . $this->targetGID . '",'
			. '"author":"' . $this->author . '",'
			. '"datePublished":"' . $this->datePublished . '",'
			. '"signature":' . $this->signature->getJSONString() . ''
			. '}';

		return $json;
	}

	protected function getStringForSignature()
	{
		return $this->objectID
				. $this->targetGID
				. $this->author
				. $this->datePublished;
	}

	const SCHEMA = '{
		"$schema": "http://json-schema.org/draft-04/schema#",
		"id": "http://jsonschema.net/sonic/trust",
		"type": "object",
		"properties":
		{
			"objectID":
			{
				"id": "http://jsonschema.net/sonic/trust/objectID",
				"type": "string"
			},
			"targetGID":
			{
				"id": "http://jsonschema.net/sonic/trust/targetGID",
				"type": "string"
			},
			"author":
			{
				"id": "http://jsonschema.net/sonic/trust/author",
				"type": "string"
			},
			"datePublished":
			{
				"id": "http://jsonschema.net/sonic/trust/datePublished,
			"type": "string"
			},
			"signature":
			{
				"id": "http://jsonschema.net/sonic/trust/signature",
				"type": "object"
			}
		},
		"required": [
			"objectID",
			"targetGID",
			"author",
			"datePublished",
			"signature"
		]
	}';
}

?>
