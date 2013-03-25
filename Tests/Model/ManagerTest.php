<?php 

namespace Jw\RestDocBundle\Tests\Model;

use Jw\RestDocBundle\DependencyInjection\JwRestDocExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;

use Jw\RestDocBundle\Model\ServiceManager;
use Jw\RestDocBundle\Model\Service;
use Jw\RestDocBundle\Model\Sample;
use Jw\RestDocBundle\Model\Error;
use Jw\RestDocBundle\Model\Info;


/**
 * Tests the functionnality provided by Model\Manager
 * 
 * @author Jérôme Weber <jerome.weber@stadline.com>
 */
class ManagerTest extends \PHPUnit_Framework_TestCase
{
	public function testGetRessources()
	{
		$container = new ContainerBuilder();
		
		$loader = new JwRestDocExtension();
		$loader->load(array(array()), $container);
	
		$serviceManager = $this->getMock('Jw\RestDocBundle\Model\ServiceManager',
				array('getDocumentations'),
				array($container));
		
		$serviceManager->expects($this->any())
			->method("getDocumentations")
			->will($this->onConsecutiveCalls(
					array(dirname(__FILE__)."/../Fixture/testManager/documentation.xml"),
					array(
						dirname(__FILE__)."/../Fixture/testManager/documentation.xml",
						dirname(__FILE__)."/../Fixture/testManager/loaded/documentation.xml",
						dirname(__FILE__)."/../Fixture/testManager/loaded/notloaded/documentation.xml",
					)
			));
		
		$this->assertEquals(array("Resources"), array_keys($serviceManager->getResources()));
		$this->assertEquals(array("Resources", "Resources2", "Resources3"), array_keys($serviceManager->getResources()));
	}
	
	public function testGetDocumentation()
	{
		$container = $this->getMock('Symfony\Component\DependencyInjection\ContainerInterface');
		
		$container->expects($this->any())
		->method("get")
		->will($this->returnCallback(
				function () {
					$args = func_get_args();
					switch($args[0])
					{
						case"jw_rest_doc.documentation":
							return array(
								dirname(__FILE__)."/../Fixture/testManager/documentation.xml",
								dirname(__FILE__)."/../Fixture/testManager/loaded",
							);
						
						break;
					}
				}
		));

		$serviceManager = new ServiceManager($container);

		$this->assertEquals(
				array(
					dirname(__FILE__)."/../Fixture/testManager/documentation.xml",
					dirname(__FILE__)."/../Fixture/testManager/loaded/documentation.xml",
				),
				$serviceManager->getDocumentations()
			);
		
	}
}