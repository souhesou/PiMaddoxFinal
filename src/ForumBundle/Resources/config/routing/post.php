<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();

$collection->add('post_index', new Route(
    '/',
    array('_controller' => 'ForumBundle:Post:index'),
    array(),
    array(),
    '',
    array(),
    array('GET')
));

$collection->add('post_show', new Route(
    '/{id}/show',
    array('_controller' => 'ForumBundle:Post:show'),
    array(),
    array(),
    '',
    array(),
    array('GET')
));

$collection->add('post_new', new Route(
    '/new',
    array('_controller' => 'ForumBundle:Post:new'),
    array(),
    array(),
    '',
    array(),
    array('GET', 'POST')
));

$collection->add('post_edit', new Route(
    '/{id}/edit',
    array('_controller' => 'ForumBundle:Post:edit'),
    array(),
    array(),
    '',
    array(),
    array('GET', 'POST')
));

$collection->add('post_delete', new Route(
    '/{id}/delete',
    array('_controller' => 'ForumBundle:Post:delete'),
    array(),
    array(),
    '',
    array(),
    array('DELETE')
));

return $collection;
