<?php

namespace AppBundle\Twig;

use Twig\Extension\AbstractExtension;

class instanceOfExtension extends AbstractExtension{

    public function getTests() {
        return [
            'instanceof' =>  new \Twig_Function_Method($this, 'isInstanceof')
        ];
    }
    
    public function isInstanceof($var, $instance) {
        return  $var instanceof $instance;
    }
}
