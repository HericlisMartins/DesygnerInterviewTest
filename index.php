<?php
/**
 * TempTrackker Console Interactor 
 * This is a small code to interacts with the TempTracker Class.
 * type " php index.php "  to start.
 * 
 * @author    Hericlis M. <hericlismartins@hotmail.com>
 */

require 'TempTracker.php';

function clearTerminal()
{
    DIRECTORY_SEPARATOR === '\\' ? popen('cls', 'w') : exec('clear');
}

$temp = null;

$TempTracker = new TempTracker();

do {
    clearTerminal();
    echo "Ctrl+C to exit...\n";
    echo "---------------------------------------------------\n";
    echo "|                TEMPERATURE TRACKER              |\n";
    echo "---------------------------------------------------\n";

    if ($temp) {

        echo "Current Temperature: " . $temp . "\xC2\xB0";

        echo "\n\nTemperature records: \n";
        foreach ($TempTracker->GetTemp($temp) as $index => $value) {
            $value = (($index + 1) % 10 == 0) ? $value . "\xC2\xB0\n" : $value . "\xC2\xB0, ";
            echo $value;
        }

        echo "\n\nHighest Temperature: ";
        echo $TempTracker->GetMax() . "\xC2\xB0";

        echo "\nLowest Temperature: ";
        echo $TempTracker->GetMin() . "\xC2\xB0";

        echo "\nAverage Temperature: ";
        echo $TempTracker->GetAvg() . "\xC2\xB0";

        echo "\n\n---------------------------------------------------\n";
    }

    echo "Insert a new temperature: ";
    fscanf(STDIN, "%d", $temp);

    if (is_int($temp)) {
        $TempTracker->SetTemp($temp);
        $TempTracker->UpdateTermometer();
    }
} while (1);
