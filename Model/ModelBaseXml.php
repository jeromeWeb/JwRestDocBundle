<?php 

namespace Jw\RestDocBundle\Model;

use SimpleXMLElement;

abstract class ModelBaseXml
{
	/**
	 * @var SimpleXMLElement
	 */
	protected $xml;
	
	/**
	 * Sets the xml data to use
	 *
	 * @param SimpleXMLElement $xml
	 * @return void
	 */
	public function setXml(SimpleXMLElement $xml)
	{
		$this->xml = $xml;
	}
	
	/**
	 * Gets the xml data to use
	 *
	 * @return SimpleXMLElement
	 */
	protected function getXml()
	{
		return $this->xml;
	}
}