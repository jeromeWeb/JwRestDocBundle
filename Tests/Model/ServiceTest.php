<?php 

namespace Jw\RestDocBundle\Tests\Model;

use Jw\RestDocBundle\Model\Service;
use Jw\RestDocBundle\Tests\Fixture\Fixture;

use \Exception;
use \SimpleXMLElement;

/**
 * Tests the functionnality provided by Model\Service
 *
 * @author Jérôme Weber <jerome.weber@stadline.com>
 */
class ServiceTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * Provides a valid SimpleXmlElement for tests
	 *
	 * @return \SimpleXMLElement
	 */
	private function getValidXml()
	{
		return Fixture::getValidServiceXml();
	}
	
	public function testGetter()
	{
		$service = new Service();

		$service->setXml($this->getValidXml());
		
		// Ressource
		$this->assertEquals("Ressources", $service->getRessource(), "Ressource is 'Ressource'");
		
		// Title
		$this->assertEquals("GET /ressources/:id", $service->getTitle(), "Title is 'GET /ressources/:id'");
		
		// Description
		$this->assertEquals("Service description", $service->getDescription(), "Description is 'Service description'");

		// Url
		$this->assertEquals("/ressources/:id.:format", $service->getUrl(), "Url is '/ressources/:id.:format'");
		
		// Method
		$this->assertEquals("GET", $service->getMethod(), "Method is 'GET'");

		// Security
		$this->assertEquals(true, $service->getSecurity(), "Security is 'true'");
		
		// Available
		$this->assertEquals(true, $service->getAvailable(), "Available is 'true'");

		// Response format
		$this->assertEquals("xml, json", $service->getFormat(), "Format is 'xml, json'");
		
		// Parameters
		$this->assertEquals(true, is_array($service->getParameters()), "Parameters is an array");
		
		// Infos
		$this->assertEquals(true, is_array($service->getInfos()), "Infos is an array");

		// Sample
		$this->assertEquals(true, is_array($service->getSamples()), "Samples is an array");
		
		// Errors
		$this->assertEquals(true, is_array($service->getErrors()), "Errors is an array");
	}
	
	/**
	 * @dataProvider providerInvalid
	 * @expectedException Exception
	 */
	public function testValidationKo(SimpleXMLElement $xml)
	{
		Service::validate($xml);
	}
	
	public function providerInvalid()
	{
		$output = array();
		$results = scandir(dirname(__FILE__)."/../Fixture/invalid/");

		foreach ($results as $result)
		{
			if (substr($result, -4) == ".xml")
			{
				$output[] = array(simplexml_load_file(dirname(__FILE__)."/../Fixture/invalid/$result"));
			}
		}

		return $output;
	}

	/**
	 * @dataProvider providerValid
	 */
	public function testValidationOk(\SimpleXMLElement $xml)
	{
		try {
			Service::validate($xml);
		} catch (Exception $e) {
			$this->assertTrue(false, "Validation must pass");
		}

		$this->assertTrue(true, "Validation OK");
	}
	
	public function providerValid()
	{
		return array(array(self::getValidXml()));
	}
	
}