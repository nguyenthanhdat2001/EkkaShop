<?php

abstract class ServiceProvider
{
    public $db;
    abstract function boot();
}
