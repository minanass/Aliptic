<?php
namespace App\Service;

class GridChecker
{
    protected static function structuredData($data) : array
    {
        $formed_data = [];
        for($i = 0; $i < 81; $i += 9 ){
            array_push($formed_data, array_slice($data, $i, 9) );
        }
        return $formed_data;
    }

    protected static function changeFormat($arrays_of_numbres) :string
    {
        $string_of_numbers = "";
        foreach ($arrays_of_numbres as $array){
            $string_of_numbers .= implode("",$array);
        }
        return $string_of_numbers;
    }

    public static function checkerAnswer($answer_unstructured, $solution) : bool
    {
        $answer = self::structuredData($answer_unstructured);
        $answer =  self::changeFormat($answer);
        $solution = self::changeFormat($solution);

        return $answer === $solution;
    }


}