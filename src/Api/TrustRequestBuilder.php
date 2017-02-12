<?php namespace sgoendoer\Sonic\Api;

use sgoendoer\Sonic\Request\OutgoingRequest;
use sgoendoer\Sonic\Api\AbstractRequestBuilder;
use sgoendoer\Sonic\Model\TrustObject;

/**
 * Creates TRUST requests
 * version 20160129
 *
 * author: Mouaz Al Qudsi
 */
class TrustRequestBuilder extends AbstractRequestBuilder
{
	const RESOURCE_NAME_TRUST = 'TRUST';

	public function createGETTrust($trustUOID)
	{
		$this->request = new OutgoingRequest();

		$this->request->setServer($this->getDomainFromProfileLocation($this->targetSocialRecord->getProfileLocation()));
		$this->request->setPath($this->getPathFromProfileLocation($this->targetSocialRecord->getProfileLocation()) . $this->targetSocialRecord->getGlobalID() . '/' . self::RESOURCE_NAME_TRUST . '/' . $trustUOID);
		$this->request->setRequestMethod('GET');

		return $this;
	}

	public function createPOSTTrust(TrustObject $trustObject)
	{
		$this->request = new OutgoingRequest();

		$this->request->setServer($this->getDomainFromProfileLocation($this->targetSocialRecord->getProfileLocation()));
		$this->request->setPath($this->getPathFromProfileLocation($this->targetSocialRecord->getProfileLocation()) . $this->targetSocialRecord->getGlobalID() . '/' . self::RESOURCE_NAME_TRUST);
		$this->request->setRequestMethod('POST');
		$this->request->setRequestBody($trustObject->getJSONString());

		return $this;
	}

	public function createDELETETrust($trustUOID)
	{
		$this->request = new OutgoingRequest();

		$this->request->setServer($this->getDomainFromProfileLocation($this->targetSocialRecord->getProfileLocation()));
		$this->request->setPath($this->getPathFromProfileLocation($this->targetSocialRecord->getProfileLocation()) . $this->targetSocialRecord->getGlobalID() . '/' . self::RESOURCE_NAME_TRUST . '/' . $trustUOID);
		$this->request->setRequestMethod('DELETE');

		return $this;
	}
}

?>
