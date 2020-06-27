<?php

namespace Romulodl;

class Mfi
{
    /**
     * Calculate the Money Flow Index
     *
     */
    public function calculate(array $hlcv_values) : float
    {
        if (empty($hlcv_values)) {
            throw new \Exception('[' . __METHOD__ . '] values parameters is invalid');
        }

        $pos_money_flow = 0;
        $neg_money_flow = 0;
        $prev_typical_price = 0;
        foreach ($hlcv_values as $val) {
			if (!$this->isValidValue($val)) {
				throw new \Exception('[' . __METHOD__ . '] invalid HLC value');
			}

            $typical_price = $this->getTypicalPrice($val[0], $val[1], $val[2]);

            if ($typical_price > $prev_typical_price) {
                $pos_money_flow += $typical_price * $val[3];
            } elseif ($typical_price < $prev_typical_price) {
                $neg_money_flow += $typical_price * $val[3];
            }

            $prev_typical_price = $typical_price;
        }

        return 100 - 100/(1 + $pos_money_flow / $neg_money_flow);
    }

    private function getTypicalPrice($high, $low, $close) {
        return ($high + $low + $close) / 3;
    }

	private function isValidValue($values) : bool
	{
		return is_array($values) &&
			count($values) === 4 &&
			is_numeric($values[0]) &&
			is_numeric($values[1]) &&
			is_numeric($values[2]) &&
			is_numeric($values[3]);
	}
}
