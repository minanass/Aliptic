<?php

    namespace App\Tests\Service;
    
    use App\Service\GridChecker;
    use PHPUnit\Framework\TestCase;
    
    class GridCheckerTest extends TestCase
    {
       
        public function teststructuredDataGridChecker()
        {
        // Arrange: préparer  les données à utiliser pour le test
        $grid = new GridChecker();
        $inputArray = [0,7,5,6,3,4,8,2,9,0,8,2,5,1,9,7,6,5,0,6,3,8,2,7,5,1,4,7,4,1,9,8,2,6,3,5,3,9,6,7,4,5,1,8,2,2,5,8,3,6,1,9,4,7,8,1,7,4,9,3,2,5,6,5,2,4,1,7,6,3,9,8,6,3,9,2,5,8,4,7,1];
        //dd($inputArray);
        // Act: appeller la méthode à tester
        $formatedArray = $grid->structuredData($inputArray);
        //dd($formatedArray);
        // Assert: comparer les résultats obtenus dans Act avec les résultats attendus 
        $this->assertEquals([[0,7,5,6,3,4,8,2,9],[0,8,2,5,1,9,7,6,5],[0,6,3,8,2,7,5,1,4],[7,4,1,9,8,2,6,3,5],[3,9,6,7,4,5,1,8,2],[2,5,8,3,6,1,9,4,7],[8,1,7,4,9,3,2,5,6],[5,2,4,1,7,6,3,9,8],[6,3,9,2,5,8,4,7,1]], $formatedArray) ;
            }

        public function testchangeFormatGridChecker()
        {
        // Arrange: préparer  les données à utiliser pour le test
        $grid = new GridChecker();
        $arrayChange = [[0,7,5,6,3,4,8,2,9],[0,8,2,4,1,9,7,6,5],[0,6,3,8,2,7,5,1,4],[7,4,1,9,8,2,6,3,5],[3,9,6,7,4,5,1,8,2],[2,5,8,3,6,1,9,4,7],[8,1,7,4,9,3,2,5,6],[5,2,4,1,7,6,3,9,8],[6,3,9,2,5,8,4,7,1]];
        //dd($array);
        // Act: appeller la méthode à tester
        $changedArray = [[1,7,5,6,3,4,8,2,9],[3,8,2,4,1,9,7,6,5],[9,6,3,8,2,7,5,1,4],[7,4,1,9,8,2,6,3,5],[3,9,6,7,4,5,1,8,2],[2,5,8,3,6,1,9,4,7],[8,1,7,4,9,3,2,5,6],[5,2,4,1,7,6,3,9,8],[6,3,9,2,5,8,4,7,1]];
       //dd($changedArray); 
       $changedArray = $grid->changeFormat($arrayChange);
        
        // Assert: comparer les résultats obtenus dans Act avec les résultats attendus
        $this->assertEquals($changedArray, $grid->changeFormat($arrayChange)) ;
            
        }
   }