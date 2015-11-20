<?php

require_once 'core/init.php';

$log = new Log();

$log->create("LOG[Väljalogimine] Kasutaja: {$user->data()->username} | Aeg: ". date('d.m.Y H:i:s', time()) ."\n");
$user->logout();
Redirect::to('index.php');