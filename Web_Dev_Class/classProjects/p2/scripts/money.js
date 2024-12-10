let homeButton;
let homeButtonMoved = false;
let moneyButtonclicked = false;
let button;
let height = window.innerHeight;
let width = window.innerWidth;

let items = [
    "Almost got me",
    "Nearly had it",
    "So close, no",
    "Close but no",
    "Nearly nailed it",
    "Almost made it",
    "Not quite there",
    "Missed by inches",
    "Just missed it",
    "Almost a win",
    "Not this time",
    "Nearly reached it",
    "So close again",
    "Barely missed it",
    "Almost but nope",
    "So close, almost",
    "Right there, no",
    "Nearly grabbed it",
    "Missed by that",
    "Almost succeeded there",
    "Close, not enough",
    "Barely off course",
    "On the edge",
    "Almost touched it",
    "Not quite yet",
    "Almost got through",
    "Missed by hair",
    "So close, fail",
    "Nearly hit target",
    "Almost had success",
    "Just shy there",
    "Almost there, nope",
    "Barely missed goal",
    "Close, not quite",
    "Missed by second",
    "Nearly completed task",
    "Almost to win",
    "Missed last step",
    "Nearly got me",
    "So close, retry",
    "Almost hit mark",
    "Missed final shot",
    "Close, but lost",
    "Almost caught it",
    "Not the one",
    "Barely, but no",
    "Close, try again",
    "Almost there, miss",
    "Missed last chance",
    "Nearly a success",
    "Just about missed"
  ];
window.onload = function(){
    setButton();
    setHomeButton();
}

function setButton(){
    button = document.querySelector("#ShinyButton");
    button.addEventListener("mouseover", function(){
        if(!moneyButtonclicked){
            button.textContent = items[Math.floor(Math.random() * items.length)];
            button.style.left = Math.random() * width + "px";
            button.style.top = Math.random() * height + "px";
        }
    })

    button.addEventListener("click", function(){
        moneyButtonclicked = !moneyButtonclicked;
        button.textContent = "YOU GOT ME! I will stop";
    })
}

function setHomeButton(){
    homeButton = document.querySelector(".homeButton");
    homeButton.addEventListener("mouseover", function(){
        if(!homeButtonMoved){
            homeButton.textContent = "HAHAHAHAHHAHAHAHAHAH";
            homeButton.style.left = Math.random() * width + "px";
            homeButton.style.top = Math.random() * height + "px";    
            homeButtonMoved = true;
        }
    })

    

}