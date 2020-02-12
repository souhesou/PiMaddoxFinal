<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();

$collection->add('besoins_index', new Route(
    '/',
    array('_controller' => 'GcampBundle:Besoins:index'),
    array(),
    array(),
    '',
    array(),
    array('GET')
));

$collection->add('besoins_show', new Route(
    '/{id}/show',
    array('_controller' => 'GcampBundle:Besoins:show'),
    array(),
    array(),
    '',
    array(),
    array('GET')
));

$collection->add('besoins_new', new Route(
    '/new',
    array('_controller' => 'GcampBundle:Besoins:new'),
    array(),
    array(),
    '',
    array(),
    array('GET', 'POST')
));

$collection->add('besoins_edit', new Route(
    '/{id}/edit',
    array('_controller' => 'GcampBundle:Besoins:edit'),
    array(),
    array(),
    '',
    array(),
    array('GET', 'POST')
));

$collection->add('besoins_delete', new Route(
    '/{id}/delete',
    array('_controller' => 'GcampBundle:Besoins:delete'),
    array(),
    array(),
    '',
    array(),
    array('DELETE')
));

return $collection;
