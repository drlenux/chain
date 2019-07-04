<?php

use DrLenux\Chain\AbstractChain;
use DrLenux\Chain\Response;

/**
 * Class IsDiv
 * @package src\factor
 *
 * @property int $a
 * @property int $b
 * @property int $c
 */
class IsDiv extends AbstractChain
{
    /**
     * @return string
     */
    static public function getStage(): string
    {
        return 'is_div';
    }

    protected function validate(): array
    {
        return ['a', 'b', 'c'];
    }


    /**
     * @return Response|null
     */
    protected function run(): ?Response
    {
        if ((
                $this->b !== 0 &&
                $this->a / $this->b === $this->c
            ) ||
            (
                $this->a !== 0 &&
                $this->b / $this->a === $this->c
            )
        ) {
            return new Response(self::getStage(), Finish::getStage(), 'div');
        }

        return null;
    }
}