function math(oper){
    num1 = parseFloat(document.querySelector("#num1").value);
    num2 = parseFloat(document.querySelector("#num2").value);

    if(isNaN(num1) || isNaN(num2)){
        alert('hello')
        showAnswer("Please Enter Valid Number")
        return
    }
    currentTime = new Date().toLocaleTimeString();
    answer = 0
    switch(oper){
        case "+":
            answer = num1 + num2
            break;
        case "-":
            answer = num1 - num2
            break;
        case "*":
            answer = num1 * num2
            break;
        case "/":
            answer = num1 / num2
            break;
        case "^":
            answer = Math.pow(num1, num2)
            break;
        case "sqr":
            answer = Math.sqrt(num1)
            break;
        default:
    }
    if(oper === "sqr"){
        document.querySelector('#history').innerHTML += "<div id='history_pf'><h3>|" + currentTime + " | " + " " + oper + " " + num1 + " = " + answer + " |</h3></div>"
    }
    else{
        document.querySelector('#history').innerHTML += "<div id='history_pf'><h3>|" + currentTime + " | " + num1 + " " + oper + " " + num2 + " = " + answer + " |</h3></div>"
    }
    document.querySelector("#answer").value = answer;

}

