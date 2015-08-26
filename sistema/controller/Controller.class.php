<?php

class Controller {

    public function Executor($class, $action) {
        try {
            $instance = new ReflectionClass($class);
            $method = new ReflectionMethod($instance->getName(), $action);
            $method->invoke(new $class, $method);
        } catch (ReflectionException $e) {
            echo $e->getMessage();
        }
    }

}
