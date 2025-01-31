<?php

declare(strict_types=1);

namespace Bolt\Widget;

use Bolt\Widget\Injector\RequestZone;
use Bolt\Widget\Injector\Target;

class BoltHeaderWidget implements WidgetInterface, ResponseAware
{
    use ResponseTrait;

    public function __invoke(array $params = []): ?string
    {
        $this->getResponse()->headers->set('X-Powered-By', 'Bolt', false);

        return null;
    }

    public function getName(): string
    {
        return 'Bolt Header Widget';
    }

    public function getTarget(): string
    {
        return Target::NOWHERE;
    }

    public function getPriority(): int
    {
        return 0;
    }

    public function getZone(): string
    {
        return RequestZone::FRONTEND;
    }
}
