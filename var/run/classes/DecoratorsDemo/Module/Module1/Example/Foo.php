<?php

namespace DecoratorsDemo\Module\Module1\Example;

 class Foo extends \DecoratorsDemo\Example\FooOriginal implements \Includes\DecoratorInterface {
    public function run() {
        echo parent::run() . ' modified by Module1';
    }
} 