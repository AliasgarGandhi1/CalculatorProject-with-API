window.onload = runScript;

//Executed after HTML page loaded. 
function runScript()
{
    inputField = document.getElementById("dispScreen");
}

//Executed when user clicks on any button except = and C.
function display(ip)
{
    inputField.value += ip;
}

//Executed when user clicks on C button.
function Clear()
{
    inputField.value = "";
}    

//Storing the URL of API.
var queryString = "http://localhost/Project/CalculatorXML_API.php?";
//apivanier-env.eba-eyipxp2t.ca-central-1.elasticbeanstalk.com
//AJAX Code.
var onRequest = new XMLHttpRequest(); //Creating an object of the XMLHttpRequest request
onRequest.addEventListener("load", reqListener); // Adding a function that would be called when the API gives us a response


//This function will call when API sends the response.
function reqListener(){
    document.getElementById('result').innerHTML=this.responseText;
}


//Function will call when user clicks on = button.
function callAPI()
{
    let expression = inputField.value;
    let no1="", no2="", operator="";
    let i;

    for(i=0; i<expression.length; i++)
    {
        //This condition will check that the character is number or any other letter or special character.
        //If it's number if block will bw executed.
        //charCodeAt function returns the ASCII value of number.
        if(expression.charCodeAt(i) > 47 && expression.charCodeAt(i)<58)
        {
            no1+=expression[i];
        }
        else
        {
            operator = expression[i];
            break;
        }
    }
    no2 = expression.substring(i+1,expression.length);
   
    switch (operator)
    {
        case '+': operator="ADD";
                  break;

        case '-': operator="SUB";
                  break; 

        case '*': operator="MUL";
                  break;         
                  
        case '/': operator="DIV";
                  break; 

        case '%': operator="MOD";
                  break; 

        case '^': operator="POW";
                  break; 

        case '!': operator="FACT";
                  break; 

        default: console.log("Something is wrong");
    }
    onRequest.open("GET",queryString+"no1="+no1+"&no2="+no2+"&operation="+operator); // Creating the request for the API
    onRequest.send(); // Calling the API

    Clear();     
}


