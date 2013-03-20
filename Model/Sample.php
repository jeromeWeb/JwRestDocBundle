<?php 

namespace Jw\RestDocBundle\Model;

use Jw\RestDocBundle\Model\ModelBaseXml;

class Sample extends ModelBaseXml
{
	/**
	 * Gets the method used in the sample
	 * 
	 * @return string
	 */
	public function getMethod()
	{
		return (string) $this->getXml()->METHOD;
	}
	
	/**
	 * Gets the url used in the sample
	 *
	 * @return string
	 */
	public function getUrl()
	{
		return (string) $this->getXml()->URL;
	}	
	
	/**
	 * Gets the format used in the sample
	 * 
	 * @return string
	 */
	public function getFormat()
	{
		return (string) $this->getXml()->FORMAT;
	}

	/**
	 * Gets the statuscode returned in the sample
	 * 
	 * @return string
	 */
	public function getStatusCode()
	{
		return (string) $this->getXml()->STATUSCODE;
	}
	
	/**
	 * Gets the response returned in the sample
	 *
	 * @return string
	 */
	public function getResponse()
	{
		return (string) $this->getXml()->RESPONSE;
	}
	
	
}