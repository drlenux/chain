<?php

use DrLenux\Chain\AbstractChain;
use DrLenux\Chain\Response;

/**
 * Class IsSub
 * @package src\factor
 */
class IsSub extends AbstractChain
{

    /**
     * @return string
     */
    static public function getStage(): string
    {
        return 'is_sub';
    }

    /**
     * @return Response|null
     */
    protected function run(): ?Response
    {
        $a = $this->a;
        $b = $this->b;
        $c = $this->c;

        if (
            $a - $b === $c ||
            $b - $a === $c
        ) {
            return new Response(self::getStage(), Finish::getStage(), 'sub');
        }

        return null;
    }
}