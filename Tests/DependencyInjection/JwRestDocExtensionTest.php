<?php

namespace Jw\RestDocBundle\Tests\DependencyInjection;

use Jw\RestDocBundle\DependencyInjection\JwRestDocExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Parameter;
use Symfony\Component\DependencyInjection\Reference;

class JwRestDocExtensionTest extends \PHPUnit_Framework_TestCase
{
    public function testDefault()
    {
    	$container = new ContainerBuilder();
    	$loader = new JwRestDocExtension();
    	$loader->load(array(array()), $container);
    	
    	$this->assertEquals("Rest API", $container->getParameter('jw_rest_doc.title'), 'The title is loaded');
    }
}