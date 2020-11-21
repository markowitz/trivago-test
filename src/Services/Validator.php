<?php

namespace App\Services;

use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints as Assert;

class Validator
{

     /**
     * validates the hotel data
     * @param array $hotel
     * @return Symfony\Component\Validator\ConstraintViolationList object
     */
    public static function validate(array $hotel)
    {
        $validator = Validation::createValidator();
        $constraint = new Assert\Collection([
            "fields" => [
                'name' => new Assert\Regex(["pattern" => "/[^\x20-\x7e]/", "match" => false]),
                'address' => new Assert\Regex(["pattern" => "/[^\x20-\x7e]/", "match" => false]),
                'stars' => [new Assert\LessThanOrEqual(5), new Assert\PositiveOrZero()],
                'contact' => new Assert\Regex(["pattern" => "/[^\x20-\x7e]/", "match" => false]),
                'uri' => new Assert\Url()
            ],
            "allowExtraFields" => true
        ]);

        return $validator->validate($hotel, $constraint);
    }
}