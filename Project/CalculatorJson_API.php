<?php
    // header("Access-Control-Allow-Origin: ".$_SERVER['HTTP_ORIGIN']);

    error_reporting(0);
    // $connection = new mysqli();
    // $no1=strip_tags(mysqli_real_escape_string($connection, $_REQUEST['no1']));
    // $no2=strip_tags(mysqli_real_escape_string($connection, $_REQUEST['operation']));
    // $operator=strip_tags(mysqli_real_escape_string($connection, $_REQUEST['no2']));

    $result = 0;
    $no1 = 0;
    $no2 = 0;
    $operator = $_REQUEST['operation'];

    ////Executes when no1 or no2 are null and operation is not Factorial.
    if(($_REQUEST['no1']=="" || $_REQUEST['no2']=="") && $operator !="FACT")
    {
        echo json_encode(array("errorCode"=>101, "errorDescription"=>"Number 1 and Number 2 parameters are missing!!!."));
    }

    //Executes when no1 is null and operation is Factorial.
    elseif($_REQUEST['no1']=="" && $operator=="FACT")
    {
        echo json_encode(array("errorCode"=>102, "errorDescription"=>"To perform Factorial You have to enter value before operator."));
    }

    //Executes when no1 and no2 are not null.
    elseif ($_REQUEST['no1']!="" && $_REQUEST['no2']!="")
    {
        $no1 = intval($_REQUEST['no1']);
        $no2 = intval($_REQUEST['no2']);

        //Executes when operation is Addition.
        if($operator == "ADD")
        {
            $result = $no1 + $no2;
            echo json_encode (array("Number 1" => $no1, "Operation" => "+", "Number 2" => $no2, "Result"=>$result));
        }

        //Executes when operation is Subtraction.
        elseif($operator == "SUB")
        {
            $result = $no1 - $no2;
            echo json_encode (array("Number 1" => $no1, "Operation" => "-", "Number 2" => $no2, "Result"=>$result));
        }

        //Executes when operation is Multiplication.
        elseif($operator == "MUL")
        {
            $result = $no1 * $no2;
            echo json_encode (array("Number 1" => $no1, "Operation" => "*", "Number 2" => $no2, "Result"=>$result));
        }

        //Executes when operation is Division.
        elseif($operator == "DIV")
        {
            $result = $no1 / $no2;
            echo json_encode (array("Number 1" => $no1, "Operation" => "/", "Number 2" => $no2, "Result"=>$result));
        }

        //Executes when operation is Modulation.
        elseif($operator == "MOD")
        {
            $result = $no1 % $no2;
            echo json_encode (array("Number 1" => $no1, "Operation" => "%", "Number 2" => $no2, "Result"=>$result));
        }

        //Executes when operation is Power.
        elseif($operator == "POW")
        {
            $result = pow($no1, $no2);
            echo json_encode (array("Number 1" => $no1, "Operation" => "^", "Number 2" => $no2, "Result"=>$result));
        }
    }
    
    //Execute when no1 is not null and operation is Factorial.
    if($_REQUEST['no1'] != "" && $operator == "FACT")
    {
        $no = $_REQUEST['no1'];
        $factorial = 1;
        for ($i=$no; $i>=1; $i--)   
        {  
            $factorial = $factorial * $i;  
        } 
        echo json_encode (array("Number 1" => $no, "Operation" => "!", "Result"=>$factorial));
    }
    
?>