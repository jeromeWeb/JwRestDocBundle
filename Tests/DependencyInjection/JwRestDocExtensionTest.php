<?php

namespace Jw\RestDocBundle\Tests\DependencyInjection;

use Jw\RestDocBundle\DependencyInjection\JwRestDocExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Parameter;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\Yaml\Parser;

class JwRestDocExtensionTest extends \PHPUnit_Framework_TestCase
{
	protected $configuration;
	
    public function testDefault()
    {
    	$this->configuration = new ContainerBuilder();
    	$loader = new JwRestDocExtension();
    	$loader->load(array(array()), $this->configuration);
    	
    	$this->assertParameter("Rest API", "jw_rest_doc.title");
    	$this->assertTrue(is_array($this->configuration->getParameter('jw_rest_doc.documentation')), 'Documentation is an array');
    	$this->assertEquals(0, count($this->configuration->getParameter('jw_rest_doc.documentation')), 'Documentation is empty');
    }
    
    public function testCustomTitle()
    {	
    	$this->createFullConfiguration();
    	
    	$this->assertParameter("Custom title", "jw_rest_doc.title");
    }

    public function testCustomDocumentation()
    {
    	$this->createFullConfiguration();
    	 
    	$this->assertParameter(array("doc/folder", "doc/test/file.xml"), "jw_rest_doc.documentation");
    }
    
    protected function createFullConfiguration()
    {
		$this->configuration = new ContainerBuilder();
		$loader = new JwRestDocExtension();
		$loader->load(array($this->getFullConfig()), $this->configuration);
		
		$this->assertTrue($this->configuration instanceof ContainerBuilder);
    }
    
    /**
     * @param mixed  $value
     * @param string $key
     */
    private function assertParameter($value, $key)
    {
    	$this->assertEquals($value, $this->configuration->getParameter($key), sprintf('%s parameter is correct', $key));
    }
    
    private function getFullConfig()
    {
    	$yaml = <<<EOF
title: Custom title
documentation:
    - "doc/folder"
    - "doc/test/file.xml"
EOF;
    	
    	$parser = new Parser();
    	
    	return  $parser->parse($yaml);    	
    }
}