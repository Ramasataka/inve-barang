<?php

spl_autoload_register(function( $class ){
    require_once __DIR__ .'/classes/' . $class . '.php';
});