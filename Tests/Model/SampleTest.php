<?php 

namespace Jw\RestDocBundle\Tests\Model;

use Jw\RestDocBundle\Model\Sample;
use Jw\RestDocBundle\Tests\Fixture\Fixture;

/**
 * Tests the functionnality provided by Model\Sample
 * 
 * @author Jérôme Weber <jerome.weber@stadline.com>
 */
class SampleTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * Provides a valid SimpleXmlElement for tests
	 * 
	 * @return \SimpleXMLElement
	 */
	private function getValidXml()
	{
		return Fixture::getValidSampleXml();
	}
	
	/**
	 * Tests all the getter values for a valid xml
	 */
	public function testGetter()
	{
		$sample = new Sample();
		$sample->setXml($this->getValidXml());
		
		// method
		$this->assertEquals("GET", $sample->getMethod(), "Method is GET");

		//url
		$this->assertEquals("/ressources/1234.xml", $sample->getUrl(), "Url is /ressources/1234.xml");
		
		//format
		$this->assertEquals("xml", $sample->getFormat(), "Format is xml");
		
		//statuscode
		$this->assertEquals("200", $sample->getStatuscode(), "status code is 200");
		
		//response
		$this->assertContains("OK : View successfully calculated", $sample->getResponse(), "Get a response");
	}
}