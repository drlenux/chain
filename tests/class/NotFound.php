<?php

use DrLenux\Chain\AbstractChain;
use DrLenux\Chain\Response;

/**
 * Class NotFound
 * @package src\factor
 */
class NotFound extends AbstractChain
{

    /**
     * @return string
     */
    static public function getStage(): string
    {
        return 'not_found';
    }

    /**
     * @return Response|null
     */
    protected function run(): ?Response
    {
        return new Response(self::getStage(), Finish::getStage(), 'not found');
    }
}