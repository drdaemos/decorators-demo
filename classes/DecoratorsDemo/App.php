<?php

namespace DecoratorsDemo;

class App {
    public function run() {
        $object = \DecoratorsDemo\Example\Foo();

        $object->run();
    }
}