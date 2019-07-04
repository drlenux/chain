<?php

use DrLenux\Chain\AbstractChain;
use DrLenux\Chain\Response;

/**
 * Class ValidateInt
 * @package src\factor
 */
class ValidateInt extends AbstractChain
{
    /**
     * @return string
     */
    static public function getStage(): string
    {
        return 'validate_int';
    }

    protected function validate(): array
    {
        return [
            'a', 'b', 'c'
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

        if (
            is_int($a) &&
            is_int($b) &&
            is_int($c)
        ) {
            return null;
        }

        return new Response(self::getStage(), null, 'is not int');
    }
}