<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the public 'ps_checkout.cache.paypal.order' shared service.

return $this->services['ps_checkout.cache.paypal.order'] = new \Symfony\Component\Cache\Simple\FilesystemCache('paypal-orders', 3600, ${($_ = isset($this->services['ps_checkout.cache.directory']) ? $this->services['ps_checkout.cache.directory'] : ($this->services['ps_checkout.cache.directory'] = new \PrestaShop\ModuleLibCacheDirectoryProvider\Cache\CacheDirectoryProvider('1.7.8.6', 'D:\\webbax', true))) && false ?: '_'}->getPath());
