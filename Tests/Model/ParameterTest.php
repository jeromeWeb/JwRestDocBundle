<?php 

namespace Jw\RestDocBundle\Tests\Model;

use Jw\RestDocBundle\Model\Parameter;
use \SimpleXMLElement;
use Jw\RestDocBundle\Tests\Fixture\Fixture;

/**
 * Tests the functionnality provided by Model\Parameter
 * 
 * @author Jérôme Weber <jerome.weber@stadline.com>
 */
class ParameterTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * Provides a valid SimpleXmlElement for tests
	 * 
	 * @return \SimpleXMLElement
	 */
	private function getValidXml()
	{
		return Fixture::getValidParameterXml();
	}
	
	/**
	 * Tests all the getter values for a valid xml
	 */
	public function testGetter()
	{
		$parameter = new Parameter();
		$parameter->setXml($this->getValidXml());
		
		// name
		$this->assertEquals("id", $parameter->getName());

		//default
		$this->assertEquals("1234", $parameter->getDefault());
		
		//sample
		$this->assertEquals("5678", $parameter->getSample());
		
		//description
		$this->assertEquals("Param description", $parameter->getDescription());
		
		//required
		$this->assertEquals(true, $parameter->getRequired());
	}
}