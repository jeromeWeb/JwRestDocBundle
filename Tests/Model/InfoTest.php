<?php 

namespace Jw\RestDocBundle\Tests\Model;

use Jw\RestDocBundle\Model\Info;
use Jw\RestDocBundle\Tests\Fixture\Fixture;

/**
 * Tests the functionnality provided by Model\Info
 *
 * @author Jérôme Weber <jerome.weber@stadline.com>
 */
class InfoTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * Provides a valid SimpleXmlElement for tests
	 *
	 * @return \SimpleXMLElement
	 */
	private function getValidXml()
	{
		return Fixture::getValidInfoXml();
	}

	/**
	 * Tests all the getter values for a valid xml
	 */
	public function testGetter()
	{
		$info = new Info();
		$info->setXml($this->getValidXml());

		// title
		$this->assertEquals("Title", $info->getTitle(), "Title is 'Title'");

		// content
		$this->assertEquals("Article", $info->getContent(), "Content is 'Article'");
	}
}