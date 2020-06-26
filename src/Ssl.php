<?php

namespace Romulodl;

class Ssl
{
    /**
     * Calculate the Ssl channel,
     * returns 1 for positive channel and -1 for negative
     */
    public function calculate(array $hlc_values, int $period = 10) : int
    {
        if (empty($hlc_values)) {
            throw new \Exception('[' . __METHOD__ . '] values parameters is invalid');
        }

        $high = [];
        $low = [];
        $close = 0;
        foreach ($hlc_values as $val) {
			if (!$this->isValidHLCValue($val)) {
				throw new \Exception('[' . __METHOD__ . '] invalid HLC value');
			}

            $high[] = $val[0];
            $low[] = $val[1];

            if (count($high) < $period) {
                continue;
            }

            $sma_high = array_sum(array_slice($high, -1 * $period)) / $period;
            $sma_low = array_sum(array_slice($low, -1 * $period)) / $period;
            $close = $val[2] > $sma_high ? 1 : $close < $sma_low ? -1 : $close;
        }

        return $close;
    }

	private function isValidHLCValue($values) : bool
	{
		return is_array($values) &&
			count($values) === 3 &&
			is_numeric($values[0]) &&
			is_numeric($values[1]) &&
			is_numeric($values[2]);
	}
}
