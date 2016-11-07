<?php

namespace Lean\Bundle;

use Lean\Bundle\DependencyInjection\Compiler\QueryBusPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class LeanBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new QueryBusPass());
    }
}