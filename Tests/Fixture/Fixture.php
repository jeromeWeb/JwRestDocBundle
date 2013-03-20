<?php 

namespace Jw\RestDocBundle\Tests\Fixture;

use \SimpleXMLElement;

/**
 * Provides values for tests
 * 
 * @author Jérôme Weber <jerome.weber@stadline.com>
 */
class Fixture
{
	/**
	 * Provides a param sample
	 * 
	 * @return \SimpleXMLElement
	 */
	public static function getValidParameterXml()
	{
		$xml = simplexml_load_file(dirname(__FILE__)."/documentation.xml");
		return $xml->PARAMS->PARAM;
	}

	/**
	 * Provides a sample
	 *
	 * @return \SimpleXMLElement
	 */
	public static function getValidSampleXml()
	{
		$xml = simplexml_load_file(dirname(__FILE__)."/documentation.xml");
		return $xml->SAMPLES->SAMPLE;
	}
	
}