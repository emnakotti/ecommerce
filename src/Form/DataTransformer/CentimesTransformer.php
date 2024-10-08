<?php

namespace App\Form\DataTransformer;

use symfony\component\Form\DataTransformerInterface;

class CentimesTransformer implements DataTransformerInterface
{

    public function transform($value)
    {
        if ($value === null) {
            return;
        }
        return $value / 100;
    }
    public function reverseTransform($value)
    {
        if ($value === null) {
            return;
        }
        return $value * 100;
    }
}
