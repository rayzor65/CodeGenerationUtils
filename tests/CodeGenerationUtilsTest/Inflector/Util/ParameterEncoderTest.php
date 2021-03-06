<?php
/*
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the MIT license.
 */

declare(strict_types=1);

namespace CodeGenerationUtilsTest\Inflector\Util;

use PHPUnit\Framework\TestCase;
use CodeGenerationUtils\Inflector\Util\ParameterEncoder;

/**
 * Tests for {@see \CodeGenerationUtils\Inflector\Util\ParameterEncoder}
 *
 * @author Marco Pivetta <ocramius@gmail.com>
 * @license MIT
 */
class ParameterEncoderTest extends TestCase
{
    /**
     * @dataProvider getParameters
     *
     * @covers \CodeGenerationUtils\Inflector\Util\ParameterEncoder::encodeParameters
     *
     * @param array $parameters
     */
    public function testGeneratesValidClassName(array $parameters)
    {
        $encoder = new ParameterEncoder();

        self::assertRegExp(
            '/[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]+/',
            $encoder->encodeParameters($parameters),
            'Encoded string is a valid class identifier'
        );
    }

    /**
     * @return array
     */
    public function getParameters()
    {
        return array(
            array(array()),
            array(array('foo' => 'bar')),
            array(array('bar' => 'baz')),
            array(array(null)),
            array(array(null, null)),
            array(array('bar' => null)),
            array(array('bar' => 12345)),
            array(array('foo' => 'bar', 'bar' => 'baz')),
        );
    }
}
