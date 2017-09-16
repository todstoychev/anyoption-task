<?php

namespace framework\DataProcessor;

class UserNameProcessor
{
    /**
     * @param string $name
     *
     * @return string
     */
    public function process(string $name): string
    {
        $names = explode(',', $name);
        $lastName = trim(array_shift($names));
        $firstName = trim(array_shift($names));

        return $firstName.' '.$lastName;
    }
}