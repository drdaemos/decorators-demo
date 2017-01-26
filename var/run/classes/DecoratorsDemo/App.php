<?php

namespace DecoratorsDemo;

class App {
    public function run() {
        $object = new \DecoratorsDemo\Example\Foo();

        $object->run();

        echo PHP_EOL;
    }
}