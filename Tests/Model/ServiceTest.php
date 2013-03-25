<?php 

namespace Jw\RestDocBundle\Tests\Model;

use Jw\RestDocBundle\Model\Error;

use Jw\RestDocBundle\Model\Sample;

use Jw\RestDocBundle\Model\Info;

use Jw\RestDocBundle\Model\Parameter;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Jw\RestDocBundle\DependencyInjection\JwRestDocExtension;
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
		
		$container = $this->getMock('Symfony\Component\DependencyInjection\ContainerInterface');

		$container->expects($this->any())
		->method("get")
		->will($this->returnCallback(
			function () {
				$args = func_get_args();
				switch($args[0])
				{
					case"jw_rest_doc.parameter":
						return new Parameter();
					break;
					case"jw_rest_doc.sample":
						return new Sample();
					break;
					case"jw_rest_doc.info":
						return new Info();
					break;
					case"jw_rest_doc.error":
						return new Error();
					break;
				}
			}
		));

		$service = new Service($container);
		
		$service->setXml($this->getValidXml());
		
		// Ressource
		$this->assertEquals("Resources", $service->getResource(), "Resource is 'Resource'");
		
		// Title
		$this->assertEquals("GET /resources/:id", $service->getTitle(), "Title is 'GET /resources/:id'");
		
		// Description
		$this->assertEquals("Service description", $service->getDescription(), "Description is 'Service description'");

		// Url
		$this->assertEquals("/resources/:id.:format", $service->getUrl(), "Url is '/resources/:id.:format'");
		
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