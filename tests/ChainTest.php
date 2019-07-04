<?php

use DrLenux\Chain\Response;
use PHPUnit\Framework\TestCase;
use DrLenux\Chain\AbstractChain;

require __DIR__ . '/class/Finish.php';
require __DIR__ . '/class/IsDiv.php';
require __DIR__ . '/class/IsSub.php';
require __DIR__ . '/class/IsSum.php';
require __DIR__ . '/class/NotFound.php';
require __DIR__ . '/class/ValidateInt.php';

/**
 * Class ChainTest
 */
class ChainTest extends TestCase
{
    private function initChain(): AbstractChain
    {
        $chain = new ValidateInt();
        $chain->setNext(new IsSum())
            ->setNext(new IsSub())
            ->setNext(new IsDiv())
            ->setNext(new NotFound())
            ->setNext(new Finish());
        return $chain;
    }

    private function runChain(AbstractChain $chain, array $request, ?Response $response = null): Response
    {
        while (true) {
            $response = $chain->handler($request, $response);
            if ($response !== null && $response->getNextStage() === null) {
                break;
            }
        }
        return $response;
    }

    /**
     * @param array $request
     * @param string $expected
     * @dataProvider dataProviderForData
     */
    public function testData(array $request, string $expected)
    {
        $chain = $this->initChain();
        $response = $this->runChain($chain, $request);
        $this->assertEquals($expected, $response->getMessage());
    }

    public function dataProviderForData()
    {
        return [
            [
                ['a' => 1, 'b' => 1, 'c' => 1],
                'div'
            ],
            [
                ['a' => 1, 'b' => 2, 'c' => 1],
                'sub'
            ],
            [
                ['a' => 1, 'b' => 2.0, 'c' => 1],
                'is not int'
            ],
            [
                ['a' => 1, 'b' => 2, 'c' => 10],
                'not found'
            ],
        ];
    }
}
