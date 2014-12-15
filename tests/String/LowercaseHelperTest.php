<?php
/*
 * This file is part of Handlebars.php Helpers Set
 *
 * (c) Dmitriy Simushev <simushevds@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JustBlackBird\HandlebarsHelpers\Tests\String;

use JustBlackBird\HandlebarsHelpers\String\LowercaseHelper;

/**
 * Test class for "lowercase" helper.
 *
 * @author Dmitriy Simushev <simushevds@gmail.com>
 */
class LowercaseHelperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests that strings are converted to lowercase properly.
     *
     * @dataProvider convertProvider
     */
    public function testConvert($string)
    {
        $helpers = new \Handlebars\Helpers(array('lowercase' => new LowercaseHelper()));
        $engine = new \Handlebars\Handlebars(array('helpers' => $helpers));

        $this->assertEquals(
            $engine->render(
                '{{lowercase str}}',
                array('str' => $string)
            ),
            strtolower($string)
        );
    }

    /**
     * A data provider for testConvert method.
     */
    public function convertProvider()
    {
        return array(
            array('already in lower'),
            array('Mixed Case String'),
            array('ANOther mIxed CASE string'),
            array('STRING IN CAPS'),
        );
    }

    /**
     * Tests that exception is thrown if wrong number of arguments is used.
     *
     * @expectedException InvalidArgumentException
     * @dataProvider wrongArgumentsProvider
     */
    public function testArgumentsCount($template)
    {
        $helpers = new \Handlebars\Helpers(array('lowercase' => new LowercaseHelper()));
        $engine = new \Handlebars\Handlebars(array('helpers' => $helpers));

        $engine->render($template, array());
    }

    /**
     * A data provider for testArgumentsCount method.
     */
    public function wrongArgumentsProvider()
    {
        return array(
            // Not enough arguments
            array('{{lowercase}}'),
            // Too much arguments
            array('{{lowercase "Arg" "ANOTHER ARG"}}'),
        );
    }
}
