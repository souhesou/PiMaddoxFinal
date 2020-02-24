<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();

$collection->add('camp_index', new Route(
    '/',
    array('_controller' => 'GcampBundle:Camp:index'),
    array(),
    array(),
    '',
    array(),
    array('GET')
));

$collection->add('camp_show', new Route(
    '/{id}/show',
    array('_controller' => 'GcampBundle:Camp:show'),
    array(),
    array(),
    '',
    array(),
    array('GET')
));
$collection->add('camp_map', new Route(
    '/{id}/map',
    array('_controller' => 'GcampBundle:Camp:map'),
    array(),
    array(),
    '',
    array(),
    array('GET')
));
$collection->add('camp_local', new Route(
    '/{id}/local',
    array('_controller' => 'GcampBundle:Camp:local'),
    array(),
    array(),
    '',
    array(),
    array('GET')
));

$collection->add('camp_pdf', new Route(
    '/{id}/pdf',
    array('_controller' => 'GcampBundle:Camp:pdf'),
    array(),
    array(),
    '',
    array(),
    array('GET')
));


$collection->add('camp_new', new Route(
    '/new',
    array('_controller' => 'GcampBundle:Camp:new'),
    array(),
    array(),
    '',
    array(),
    array('GET', 'POST')
));

$collection->add('camp_edit', new Route(
    '/{id}/edit',
    array('_controller' => 'GcampBundle:Camp:edit'),
    array(),
    array(),
    '',
    array(),
    array('GET', 'POST')
));

$collection->add('camp_delete', new Route(
    '/{id}/delete',
    array('_controller' => 'GcampBundle:Camp:delete'),
    array(),
    array(),
    '',
    array(),
    array('DELETE')
));

return $collection;
