<?php
use Dzava\Lighthouse\Lighthouse;

(new Lighthouse())
    ->setOutput('report.json')
    ->accessibility()
    ->bestPractices()
    ->performance()
    ->pwa()
    ->seo()
    ->audit('https://www.larashout.com/');