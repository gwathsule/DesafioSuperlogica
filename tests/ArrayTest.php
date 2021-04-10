<?php

use PHPUnit\Framework\TestCase;

class ArrayTest extends TestCase
{
    public function testArray()
    {
        //1) Crie um array
        $numbers = [];

        //2) Popule este array com 7 números
        $numbers[] = 2;
        $numbers[] = 9;
        $numbers[] = 7;
        $numbers[] = 0;
        $numbers[] = 8;
        $numbers[] = 2;
        $numbers[] = 4;
        //3) Imprima o número da posição 3 do array
        $third = $numbers[2];
        $this->assertEquals(7, $third);

        //4) Crie uma variável com todas as posições do array no formato de string separado por vírgula
        $stringNumbers = implode(',', $numbers);
        $this->assertEquals("2,9,7,0,8,2,4", $stringNumbers);

        //5) Crie um novo array a partir da variável no formato de string que foi criada
        $newArray = array_map('intval', explode(',', $stringNumbers));
        $this->assertEquals($numbers, $newArray);

        //6) Crie uma condição para verificar se existe o valor 14 no array
        $exists14 = in_array(14, $numbers);
        $this->assertFalse($exists14);

        //7) Faça uma busca em cada posição. Se o número da posição atual for menor que aposição anterior,
        //   exclua esta posição
        $reducedArray = $numbers;
        for($i=1; $i<count($numbers); $i++) {
            if($numbers[$i] < $numbers[$i-1]) {
                unset($reducedArray[$i]);
            }
        }
        $this->assertEquals([
            0 => 2,
            1 => 9,
            4 => 8,
            6 => 4
        ], $reducedArray);

        //8) Remova a última posição deste array
        $reducedArray = $numbers;
        array_pop($reducedArray);
        $this->assertEquals([2,9,7,0,8,2], $reducedArray);
        //9) Conte quantos elementos tem neste array
        $sum = count($numbers);
        $this->assertEquals(7, $sum);

        //10) Inverta as posições deste array 2,9,7,0,8,2,4
        $inverseArray = array_reverse($numbers);
        $this->assertEquals([
            0 => 4,
            1 => 2,
            2 => 8,
            3 => 0,
            4 => 7,
            5 => 9,
            6 => 2,
        ], $inverseArray);
    }
}