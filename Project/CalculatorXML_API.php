<?php
    //To hide warning on webpage.
    error_reporting(0);

    // $connection = new mysqli();
    // $no1=strip_tags(mysqli_real_escape_string($connection, $_REQUEST['no1']));
    // $no2=strip_tags(mysqli_real_escape_string($connection, $_REQUEST['operation']));
    // $operator=strip_tags(mysqli_real_escape_string($connection, $_REQUEST['no2']));

    //Creating an object to store XML in PHP
    $dom = new DOMDocument('1.0','UTF-8');
    $dom->formatOutput = true;

    $result = 0; 
    $no1 = 0; 
    $no2 = 0;
    $operator = $_REQUEST['operation'];
    $op; //<operator></operator>
    $number1; //<number1></number1>
    $number2; //<number2></number2>
    $answer; //<answer></answer>


    if(($_REQUEST['no1']=="" || $_REQUEST['no2']=="") && $operator != "FACT")
    {
        echo json_encode(array("errorCode"=>101, "errorDescription"=>"Number 1 and Number 2 parameters are missing!!!.")); 
    }

    elseif($_REQUEST['no1']=="" && $operator=="FACT")
    {
        echo json_encode(array("errorCode"=>102, "errorDescription"=>"To perform Factorial You have to enter value before operator."));
    }

    elseif ($_REQUEST['no1']!="" && $_REQUEST['no2']!="")
    {
        $no1 = intval($_REQUEST['no1']);
        $no2 = intval($_REQUEST['no2']);

        //Creating the root element and adding it to the DOM object
        $root = $dom->createElement('Calculator');
        $dom->appendChild($root);//<calculator></calculator>

        //Adding the expression to the root (Calculator)
        $expression = $dom->createElement('Expression');
        $root->appendChild($expression);
        //<calculator><expression></expression></calculator>

        //10+20
        //Creating 2 children for expression (number1, number2)
        $number1 = $dom->createElement('number1', $no1); //<number1>10</number1>
        $number2 = $dom->createElement('number2', $no2); //<number2>20</number2>
        
        if($operator == "ADD")
        {
            $result = $no1 + $no2;
            //Creating 2 more children for expression operator and answer
            $op = $dom->createElement('operator', '+'); //<operator>+</operator>
            $answer = $dom->createElement('answer', $result); //<answer>30</answer>
        }

        elseif($operator == "SUB")
        {
            $result = $no1 - $no2;
            //Creating 2 more children for expression operator and answer
            $op = $dom->createElement('operator', '-');
            $answer = $dom->createElement('answer', $result);
        }

        elseif($operator == "MUL")
        {
            $result = $no1 * $no2;
           //Creating 2 more children for expression operator and answer
           $op = $dom->createElement('operator', '*');
           $answer = $dom->createElement('answer', $result);    
        }

        elseif($operator == "DIV")
        {
            $result = $no1 / $no2;
            //Creating 2 more children for expression operator and answer
            $op = $dom->createElement('operator', '/');
            $answer = $dom->createElement('answer', $result);
        }

        elseif($operator == "MOD")
        {
            $result = $no1 % $no2;
            //Creating 2 more children for expression operator and answer
            $op = $dom->createElement('operator', '%');
            $answer = $dom->createElement('answer', $result);
        }

        elseif($operator == "POW")
        {
            $result = pow($no1, $no2);
            //Creating 2 more children for expression operator and answer
            $op = $dom->createElement('operator', '^');
            $answer = $dom->createElement('answer', $result);
        }

        //Adding the 4 children to the expression
        $expression->appendChild($number1); 
        $expression->appendChild($op);
        $expression->appendChild($number2);
        $expression->appendChild($answer);
    }
    if($_REQUEST['no1'] != "" && $operator == "FACT")
    {
        $no = $_REQUEST['no1'];
        $factorial = 1;

        //Creating the root element and adding it to the DOM object
        $root = $dom->createElement('Calculator');
        $dom->appendChild($root);

        //Adding the expression to the root (Calculator)
        $expression = $dom->createElement('Expression');
        $root->appendChild($expression);
        // Setting the attribute id='1'
        $expression->setAttribute('id', 1);

        //Creating 2 children for expression (number1, operator)
        $number1 = $dom->createElement('number1',  $no);
        $op = $dom->createElement('operator', '!');

        for ($i=$no; $i>=1; $i--)   
        {  
            $factorial = $factorial * $i;  
        } 
        $answer = $dom->createElement('answer', $factorial);
         //Adding the 3 children to the expression
         $expression->appendChild($number1);
         $expression->appendChild($op);
         $expression->appendChild($answer);
    }
    echo $dom->saveXML();
?>