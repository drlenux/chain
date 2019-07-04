<?php

use DrLenux\Chain\AbstractChain;
use DrLenux\Chain\Response;

/**
 * Class Finish
 */
class Finish extends AbstractChain
{

    /**
     * @return string
     */
    static public function getStage(): string
    {
        return 'finish';
    }

    /**
     * @return Response|null
     */
    protected function run(): ?Response
    {
        if ($this->getResponse() !== null) {
            $message = $this->getResponse()->getMessage();
            if (strlen($message)) {
                return new Response(self::getStage(), null, $message);
            }
        }
        return null;
    }
}