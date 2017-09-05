<?php
declare(strict_types=1);

final class StringCalculator
{

    static private $defaultDelimiter = ",";

    static private function findDelimiter($numbers) {
        $tabDelimiter = array();
        $firstLine = substr($numbers, 0, strpos($numbers, "\n"));
        if(strpos($firstLine,"[") == 2){
          $firstLine = substr($firstLine, 3);
          $firstLine = substr($firstLine, 0, -1);
          $tabDelimiter = explode("][", $firstLine);
        }else{
          $firstLine = substr($firstLine, 2);
          array_push($tabDelimiter, $firstLine);
        }
        return $tabDelimiter;
    }

    static public function add(string $numbers): int
    {
        if(empty($numbers)) return 0;
        if(substr( $numbers, 0, 2 ) === "//"){
          $tabDelimiter = self::findDelimiter($numbers);
          $numbers = substr($numbers, strpos($numbers, "\n") - 1);
          foreach ($tabDelimiter as $delimiter){
              $numbers = str_replace($delimiter, self::$defaultDelimiter, $numbers);
          }
        }
        $numbers = str_replace("\n", self::$defaultDelimiter, $numbers);
        $tabNumbers = explode(self::$defaultDelimiter, $numbers);
        $sum = 0;
        $tabNegativeNumber = array();
        foreach ($tabNumbers as $number){
            if ((int)$number < 0){
                array_push($tabNegativeNumber, $number);
            }else if((int)$number >= 1000){
                //do nothing
            }else{
                $sum += (int)$number;
            }
        }
        if(count($tabNegativeNumber) > 0)throw new Exception('negatives not allowed '.implode(' ',$tabNegativeNumber));
        return $sum;
    }
}
