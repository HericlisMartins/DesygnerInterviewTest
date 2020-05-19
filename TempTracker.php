<?php
/**
 * TempTrackker - This class create a temperature tracker that you can insert temperatures and 
 * get the highest, lowest, and average temperature.
 * @author    Hericlis M. <hericlismartins@hotmail.com>
 */
class TempTracker
{

    private $temp;
    private $temp_index;
    private $temp_sum;
    private $max;
    private $min;
    private $avg;


    function __construct()
    {
        $this->temp = [];
        $this->max = $this->min = null; //null pointers
        $this->avg = $this->temp_sum = $this->temp_index  = 0; //int values
    }

    public function UpdateTermometer()
    {

        if ($this->max < $this->temp[$this->temp_index] ||  $this->temp_index == 0)  //one execution instead of MAX()
            $this->SetMax($this->temp[$this->temp_index]); //parse the reference to the memory

        if ($this->min > $this->temp[$this->temp_index] || $this->temp_index == 0) //one execution instead of MIN()
            $this->SetMin($this->temp[$this->temp_index]); //parse the reference to the memory

        /** Best Performace to get the value and key.
         * Is it less costly make 2 sum instead of use the 
         * array_sum() count() every turn
         */
        $this->temp_sum += $this->temp[$this->temp_index];
        $this->temp_index += 1;
        $this->SetAvg();
    }

    public function GetTemp()
    {
        return $this->temp;
    }

    public function SetTemp($temp)
    {
        $this->temp[] = $temp;
    }

    public function GetMax()
    {
        return $this->max;
    }

    public function SetMax(&$temp)
    /** Using Reference value instead of storage */
    {
        $this->max = &$temp;
    }

    public function GetMin()
    {
        return $this->min;
    }

    public function SetMin(&$temp)
    /** Using Reference value instead of storage */
    {
        $this->min = &$temp;
    }

    public function GetAvg()
    {
        return $this->avg;
    }

    public function SetAvg()
    {
        $this->avg = $this->temp_sum / $this->temp_index; // instead of array_sum($a) / count($a);
    }
}
