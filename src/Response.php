<?php

namespace DrLenux\Chain;

/**
 * Class Response
 * @package DrLenux\Chain
 */
class Response
{
    /**
     * @var string
     */
    private $currentStage;

    /**
     * @var string|null
     */
    private $nextStage;

    /**
     * @var string|null
     */
    private $message;

    /**
     * Response constructor.
     * @param string $currentStage
     * @param string|null $nextStage
     * @param string|null $message
     */
    public function __construct(string $currentStage, ?string $nextStage, ?string $message = null)
    {
        $this->currentStage = $currentStage;
        $this->nextStage = $nextStage;
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function getCurrentStage(): string
    {
        return $this->currentStage;
    }

    /**
     * @return string|null
     */
    public function getNextStage(): ?string
    {
        return $this->nextStage;
    }

    /**
     * @return string|null
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }
}