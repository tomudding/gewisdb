<?php

namespace Database\Controller\Factory;

use Database\Controller\MemberController;
use Database\Service\Member as MemberService;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

class MemberControllerFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param $requestedName
     * @param array|null $options
     *
     * @return MemberController
     */
    public function __invoke(
        ContainerInterface $container,
        $requestedName,
        array $options = null,
    ): MemberController {
        /** @var MemberService $memberService */
        $memberService = $container->get(MemberService::class);

        return new MemberController($memberService);
    }
}