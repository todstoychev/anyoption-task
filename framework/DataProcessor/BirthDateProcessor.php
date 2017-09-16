<?php

namespace framework\DataProcessor;

use Carbon\Carbon;

class BirthDateProcessor
{
    /**
     * @param string $date
     *
     * @return \Carbon\Carbon
     */
    public function process(string $date): Carbon
    {
        if (is_numeric($date)) {
            return Carbon::createFromTimestamp($date);
        }

        return Carbon::createFromTimestamp(strtotime($date));
    }
}