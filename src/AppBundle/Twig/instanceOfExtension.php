<?php

namespace AppBundle\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigTest;

class instanceOfExtension extends AbstractExtension{

    public function getTests() {
        return [
            new TwigTest("instanceof", array($this, 'isInstanceof'))
        ];
    }
    
    public function isInstanceof($var, $instance) {
        return  $var instanceof $instance;
    }
}
