<?php

namespace LightSaml\Tests\Action;

use LightSaml\Action\DispatchEventAction;
use LightSaml\Context\ContextInterface;
use LightSaml\Event\ActionOccurred;
use LightSaml\Tests\BaseTestCase;
use Psr\EventDispatcher\EventDispatcherInterface;

class DispatchEventActionTest extends BaseTestCase
{
    public function test_constructs_with_logger_event_dispatcher_and_event_name()
    {
        new DispatchEventAction(
            $this->getEventDispatcherMock()
        );
        $this->assertTrue(true);
    }

    public function test_dispatches_generic_event_on_execute()
    {
        $eventDispatcherMock = $this->getEventDispatcherMock();

        $action = new DispatchEventAction(
            $eventDispatcherMock
        );

        $context = $this->getContextMock();

        $eventDispatcherMock->expects($this->once())
            ->method('dispatch')
            ->with(
                $this->isInstanceOf(ActionOccurred::class)
            );

        $action->execute($context);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|\LightSaml\Context\ContextInterface
     */
    private function getContextMock()
    {
        return $this->getMockBuilder(ContextInterface::class)->getMock();
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|\Psr\EventDispatcher\EventDispatcherInterface
     */
    private function getEventDispatcherMock()
    {
        return $this->getMockBuilder(EventDispatcherInterface::class)->getMock();
    }
}
