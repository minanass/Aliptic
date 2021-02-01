<?php
namespace App\Service;

use App\Entity\Grid;
use Doctrine\ORM\EntityManagerInterface;

class GridService
{
	protected $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
		$this->entityManager = $entityManager;
    }

    protected static function structuredData($data) : array
    {
        $formed_data = [];
        for($i = 0; $i < 81; $i += 9 ){
            array_push($formed_data, array_slice($data, $i, 9) );
        }
        return $formed_data;
    }

    protected static function changeFormat($arrays_of_numbres) : string
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

    public function createGrid($data) : void
    {
        // dd($data);
        $structure =  self::structuredData(str_split($data["structure"]));
        $solution =  self::structuredData(str_split($data["solution"]));
        $grid = (new Grid())
            -> setName($data["name"])
            -> setLevel($data["level"])
            -> setInitialStructure($structure)
            -> setSolution($solution);
        $this->entityManager->persist($grid);
        $this->entityManager->flush();
    }


}