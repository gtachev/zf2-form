<?php
/**
 * StringLengthTest
 *
 * @category  StrokerForm
 * @package   StrokerForm\Renderer
 * @copyright 2012 Bram Gerritsen
 * @version   SVN: $Id$
 */

namespace StrokerFormTest\Renderer\JqueryValidate\Rule;

class StringLengthTest extends AbstractRuleTest
{
    /**
     * @return RuleInterface
     */
    protected function createRule()
    {
        return new \StrokerForm\Renderer\JqueryValidate\Rule\StringLength();
    }

    /**
     * @return ValidatorInterface
     */
    protected function createValidator()
    {
        return new \Zend\Validator\StringLength();
    }

    /**
     * Test only minlegth attribute when no max length is set on the validator
     */
    public function testMinLength()
    {
        $min = 12;
        $this->getValidator()->setMax(null);
        $this->getValidator()->setMin($min);
        $this->assertEquals(array('minlength' => $min), $this->getRules());
        $this->assertArrayHasKey('minlength', $this->getMessages());
        $this->assertArrayNotHasKey('maxlength', $this->getMessages());
    }

    /**
     * Test only maxlength attribute when no min length is set on the validator
     */
    public function testMaxLength()
    {
        $max = 12;
        $this->getValidator()->setMin(null);
        $this->getValidator()->setMax($max);
        $this->assertEquals(array('maxlength' => $max), $this->getRules());
        $this->assertArrayHasKey('maxlength', $this->getMessages());
        $this->assertArrayNotHasKey('minlength', $this->getMessages());
    }

    /**
     * Test minlength and maxlength are both set
     */
    public function testMinAndMaxLength()
    {
        $min = 5;
        $max = 20;
        $this->getValidator()->setMin($min);
        $this->getValidator()->setMax($max);
        $this->assertEquals(array('minlength' => $min, 'maxlength' => $max), $this->getRules());
        $this->assertArrayHasKey('maxlength', $this->getMessages());
        $this->assertArrayHasKey('minlength', $this->getMessages());
    }
}
