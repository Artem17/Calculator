<?php
header('Content-Type: application/json'); 
$errone = 'Укажите первый взнос';
$errtwo = 'Укажите ежемесячный доход';

if (empty($_POST['firstSum'])) {
        $results = array(
                'errone' => $errone,
        );
        echo json_encode($results); 
} elseif (empty($_POST['monthSum'])) {
        $results = array(
                'errtwo' => $errtwo,
        );
        echo json_encode($results); 
} else {
        $firstSum = $_POST["firstSum"];    //первый взнос   
        $monthSum = $_POST["monthSum"];    //ежемесячный платёж
                if (!ctype_digit($firstSum) || !ctype_digit($monthSum)){
                        $chislo = 'Для ввода данных используйте целые положительные числа';
                } elseif($firstSum < 1000000){
                        $malo = '<img src="http://mosdolshik.artnaumov.ru/wp-content/uploads/2021/11/malovato.jpg">';
                } else{
                        $s = 5000000-$firstSum;            //сумма кредита самой дешевой квартиры 5 000 000 - первый взнос
                        $p = 8.8;                          //процентная ставка 8.8%
                        $x = $monthSum;                    //присваиваем переменной х ежемесячный взнос
                        $q = 1 + ($p/1200);                //коэффициент увеличения долга 
                        $calc = $x/($x-$s*($q-1));         
                        $n= log($calc)/log($q);
                        //echo $n;                          //кол-во мес
                        $pw = pow($q,300);                //коэффициент увеличения долга возводим в степень кол-ва месяцев 300 мес (25 лет)
                        $res=$x*($pw-1)/(($q-1)*$pw);
                        $premaxsum = floor($res);                       //максимальная сумма кредита
                        //$maxsumcount = number_format($premaxsum, 0, ' ', ' ').' руб.';
                        $maxsumcount = $premaxsum;
                        }
        $proverka = $chislo;
        $err = $malo;
        $myyear = floor($n/12);
        if ($myyear == 1 xor $myyear == 21 xor $myyear == 31 xor $myyear == 41 xor $myyear == 51 xor $myyear == 61 xor $myyear == 71 xor $myyear == 81 xor $myyear == 91 xor $myyear == 101 xor $myyear == 121) {
                $nameyear = ' год';
        }elseif ($myyear == 2 xor $myyear == 3 xor $myyear == 4 xor $myyear == 22 xor $myyear == 23 xor $myyear == 24 xor $myyear == 32 xor $myyear == 33 xor $myyear == 34 xor $myyear == 42 xor $myyear == 43 xor $myyear == 44 xor $myyear == 52 xor $myyear == 53 xor $myyear == 54 xor $myyear == 62 xor $myyear == 63 xor $myyear == 64 xor $myyear == 72 xor $myyear == 73 xor $myyear == 74 xor $myyear == 82 xor $myyear == 83 xor $myyear == 84 xor$myyear == 92 xor $myyear == 102 xor $myyear == 103 xor $myyear == 104 xor $myyear == 122 xor $myyear == 123 xor $myyear == 124) {
                $nameyear = ' года';
        }else {
                $nameyear = ' лет';
        }
        $years = $myyear.$nameyear;
        $mymonths = $n%12;
        if ($mymonths == 1) {
                $namemonths = ' месяц';
        } elseif ($mymonths == 2 xor $mymonths == 3 xor $mymonths == 4) {
                $namemonths = ' месяца';
        } else {
                $namemonths = ' месяцев';
        }
        $months = $mymonths.$namemonths;
        // Формируем массив для JSON ответа
        $results = array(
                'proverka' => $proverka,
                'err' => $err,
                'maxsumcount' => $maxsumcount,
                'years' => $years,
                'months' => $months,
        ); 
        // Переводим массив в JSON
        echo json_encode($results); 
        //echo "Максимальная сумма кредита составляет ".$maxsum." рублей";
        //echo "Срок кредита на самую дешёвую квартиру составляет".$years."лет".$months."месяцев";
        }
?>