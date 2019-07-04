<?php

namespace DrLenux\Chain;

/**
 * Class AbstractChain
 * @package DrLenux\Chain
 */
abstract class AbstractChain
{
    /**
     * @var AbstractChain
     */
    private $next;

    /**
     * @var array
     */
    private $request = [];

    /**
     * @var Response|null
     */
    private $response = null;

    /**
     * @param AbstractChain $next
     * @return AbstractChain
     */
    public function setNext(AbstractChain $next): AbstractChain
    {
        $this->next = $next;
        return $next;
    }

    /**
     * @param array $request
     * @param Response|null $response
     * @return Response|null
     */
    public function handler(array $request, ?Response $response = null): ?Response
    {
        $this->request = $request;
        $this->response = $response;

        if ($response !== null) {
            if ($response->getNextStage() !== static::getStage()) {
                return $this->nextRun($request, $response);
            }
        }

        if (!$this->runValidate()) {
            return null;
        }

        $responseRun = $this->run();

        if ($responseRun !== null) {
            if ($responseRun->getNextStage() === null) {
                return $responseRun;
            }
            return $this->nextRun($request, $responseRun);
        } else {
            return $this->nextRun($request, $response);
        }
    }

    /**
     * @param $request
     * @param $response
     * @return Response
     */
    private function nextRun($request, $response): ?Response
    {
        if ($this->next !== null) {
            return $this->next->handler($request, $response);
        } else {
            return $response;
        }
    }

    /**
     * @return bool
     */
    private function runValidate(): bool
    {
        foreach ($this->validate() as $key) {
            if (empty($this->request[$key])) {
                return false;
            }
        }
        return true;
    }

    /**
     * @return array
     */
    protected function validate(): array
    {
        return [];
    }

    /**
     * @return string
     */
    abstract static public function getStage(): string;

    /**
     * @return Response|null
     */
    abstract protected function run(): ?Response;

    /**
     * @return array
     */
    public function getRequest(): array
    {
        return $this->request;
    }

    /**
     * @param $name
     * @return mixed|null
     */
    public function __get($name)
    {
        return $this->getRequest()[$name] ?? null;
    }

    /**
     * @return Response|null
     */
    public function getResponse(): ?Response
    {
        return $this->response;
    }
}