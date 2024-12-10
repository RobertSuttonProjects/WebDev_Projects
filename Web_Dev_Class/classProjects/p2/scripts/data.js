alert("Hello");

let name = getName();
let age = getAge();

alert(`Hello ${name}.\nYou Are ${age} Years Old!`)
function getName(){
    while(true){
        tempName = prompt("Enter Name")
        if(!(tempName === "")){
            return tempName
        }
    }
}

function getAge(){
    while(true){
        tempAge = +prompt("Enter Age")
        console.log("Type" + typeof(tempAge))
        if(tempAge <= 150 && tempAge >= 0 && typeof(tempAge) === "number"){
            return tempAge
        }
    }
}
