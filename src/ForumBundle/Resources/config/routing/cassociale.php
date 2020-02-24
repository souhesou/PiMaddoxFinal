<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();

$collection->add('sociale_index', new Route(
    '/',
    array('_controller' => 'ForumBundle:Cassociale:index'),
    array(),
    array(),
    '',
    array(),
    array('GET')
));
$collection->add('sociale_index_front', new Route(
    '/list',
    array('_controller' => 'ForumBundle:Cassociale:index_front'),
    array(),
    array(),
    '',
    array(),
    array('GET')
));

$collection->add('sociale_show', new Route(
    '/{id}/show',
    array('_controller' => 'ForumBundle:Cassociale:show'),
    array(),
    array(),
    '',
    array(),
    array('GET')
));
$collection->add('sociale_show_front', new Route(
    '/list/{id}/show',
    array('_controller' => 'ForumBundle:Cassociale:show_front'),
    array(),
    array(),
    '',
    array(),
    array('GET')
));

$collection->add('sociale_new', new Route(
    '/new',
    array('_controller' => 'ForumBundle:Cassociale:new'),
    array(),
    array(),
    '',
    array(),
    array('GET', 'POST')
));
$collection->add('sociale_new_front', new Route(
    '/list/new',
    array('_controller' => 'ForumBundle:Cassociale:new_front'),
    array(),
    array(),
    '',
    array(),
    array('GET', 'POST')
));

$collection->add('sociale_edit', new Route(
    '/{id}/edit',
    array('_controller' => 'ForumBundle:Cassociale:edit'),
    array(),
    array(),
    '',
    array(),
    array('GET', 'POST')
));

$collection->add('sociale_delete', new Route(
    '/{id}/delete',
    array('_controller' => 'ForumBundle:Cassociale:delete'),
    array(),
    array(),
    '',
    array(),
    array('DELETE')
));

return $collection;
