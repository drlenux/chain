<?php

use DrLenux\Chain\AbstractChain;
use DrLenux\Chain\Response;

/**
 * Class IsSum
 * @package src\factor
 */
class IsSum extends AbstractChain
{
    /**
     * @return string
     */
    static public function getStage(): string
    {
        return 'is_sum';
    }

    protected function validate(): array
    {
        return [
            'a','b','c'
        ];
    }


    /**
     * @return Response|null
     */
    protected function run(): ?Response
    {
        $a = $this->a;
        $b = $this->b;
        $c = $this->c;

        if ($a + $b === $c) {
            return new Response(self::getStage(), Finish::getStage(), 'sum');
        }

        return null;
    }
}