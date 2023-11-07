createDamier();
console.log(document.getElementById('damier'))
var pionS=null;

function createDamier() {
    var damier = document.getElementById('damier');
    for (var i = 0; i <= 9; i++) {
        for (var y = 0; y <= 9; y++) {
            if (i % 2 == 0) {
                if (y % 2 == 0) {
                    let newDiv = document.createElement("div");
                    
                    newDiv.classList.add("case-noire");
                    newDiv.dataset.x = y; // Ajout de l'indice x
                    newDiv.dataset.y = i; // Ajout de l'indice y
                    if (i <= 3) {
                        let pion = document.createElement("span");
                        pion.classList.add("pion-noir");
                        pion.addEventListener("click", select);
                        pion.addEventListener("click", selectCase);
                        newDiv.appendChild(pion);
                    } else if (i >= 6) {
                        let pion = document.createElement("span");
                        pion.classList.add("pion-blanc");
                        pion.addEventListener("click", select);
                        pion.addEventListener("click", selectCase);
                        newDiv.appendChild(pion);
                    }
                    damier.appendChild(newDiv);
                } else {
                    let newDiv = document.createElement("div");
                    
                    newDiv.classList.add("case-blanche");
                    newDiv.dataset.x = y; // Ajout de l'indice x
                    newDiv.dataset.y = i; // Ajout de l'indice y
                    damier.appendChild(newDiv);
                }
            } else {
                if (y % 2 == 0) {
                    let newDiv = document.createElement("div");
                    
                    newDiv.classList.add("case-blanche");
                    newDiv.dataset.x = y; // Ajout de l'indice x
                    newDiv.dataset.y = i; // Ajout de l'indice y
                    damier.appendChild(newDiv);
                } else {
                    let newDiv = document.createElement("div");
                    
                    newDiv.classList.add("case-noire");
                    newDiv.dataset.x = y; // Ajout de l'indice x
                    newDiv.dataset.y = i; // Ajout de l'indice y
                    if (i <= 3) {
                        let pion = document.createElement("span");
                        pion.classList.add("pion-noir");
                        pion.addEventListener("click", select);
                        pion.addEventListener("click", selectCase);
                        newDiv.appendChild(pion);
                    } else if (i >= 6) {
                        let pion = document.createElement("span");
                        pion.classList.add("pion-blanc");
                        pion.addEventListener("click", select);
                        pion.addEventListener("click", selectCase);
                        newDiv.appendChild(pion);
                    }
                    damier.appendChild(newDiv);
                }
            }
        }
    }
}

function select() {
    if (pionS != null) {
        resetCase()
        pionS.classList.remove("surligne");
    }
    if (this != pionS) {
        pionS=this;
        this.classList.add("surligne");
    }else{
        resetCase()
        pionS=null;
        this.classList.remove("surligne");
    }
}

function moove() {
    if (pionS !== null) {
        caseChoisis = this
        console.log(caseChoisis)
        if (caseChoisis.style.backgroundColor == "blue") {
            pionS.parentElement.removeChild(pionS);
            caseChoisis.appendChild(pionS);
            resetCase();
            resetSelectPion();
        }
    }
}

function mange(x,y) {
    moove();
    let caseClear=document.querySelector(`[data-x="${x}"][data-y="${y}"]`);
    console.log(caseClear)
    let pion=caseClear.firstChild;
    caseClear.removeChild(pion)
}

function resetCase() {
    let casePlateauBlack = document.getElementsByClassName("case-noire");
    let casePlateauBlanc = document.getElementsByClassName("case-blanche");
    for(let elem of casePlateauBlack){
        elem.style.backgroundColor = "black";
    }
    for(let elem of casePlateauBlanc){
        elem.style.backgroundColor = "white";
    }
}

function resetSelectPion() {
    pionS.classList.remove("surligne");
    pionS = null;
}

function selectCase() {
    if (pionS !== null) {
        resetCase();

        let caseChoisis = pionS.parentElement;
        let x = parseInt(caseChoisis.dataset.x);
        let y = parseInt(caseChoisis.dataset.y);
        let caseD = null;
        let caseG = null;

        if (pionS.classList.contains("pion-noir")) {
            if (x == 0) {
                caseD = document.querySelector(`[data-x="${x + 1}"][data-y="${y + 1}"]`);
                if (!caseD.firstChild) {
                    caseD.style.backgroundColor = "blue";
                    caseD.addEventListener("click", moove);
                } else if (caseD.firstChild && caseD.firstChild.classList.contains("pion-blanc") && !document.querySelector(`[data-x="${x + 2}"][data-y="${y + 2}"]`).firstChild) {
                    caseD = document.querySelector(`[data-x="${x + 2}"][data-y="${y + 2}"]`).style.backgroundColor = "blue";
                    caseD.addEventListener("click", mange(x+1,y+1));
                }

            } else if (x == 9) {
                caseG = document.querySelector(`[data-x="${x - 1}"][data-y="${y + 1}"]`);
                if (!caseG.firstChild) {
                    caseG.style.backgroundColor = "blue";
                    caseG.addEventListener("click", moove);
                } else if (caseG.firstChild && caseG.firstChild.classList.contains("pion-blanc") && !document.querySelector(`[data-x="${x - 2}"][data-y="${y + 2}"]`).firstChild) {
                    caseG = document.querySelector(`[data-x="${x - 2}"][data-y="${y + 2}"]`).style.backgroundColor = "blue";
                    caseG.addEventListener("click", mange(x-1,y+1));
                }
            } else {
                caseD = document.querySelector(`[data-x="${x + 1}"][data-y="${y + 1}"]`);
                caseG = document.querySelector(`[data-x="${x - 1}"][data-y="${y + 1}"]`);
                if (!caseD.firstChild) {
                    caseD.style.backgroundColor = "blue";
                    caseD.addEventListener("click", moove);
                } else if (caseD.firstChild && caseD.firstChild.classList.contains("pion-blanc")) {
                    caseD = document.querySelector(`[data-x="${x + 2}"][data-y="${y + 2}"]`).style.backgroundColor = "blue";
                    caseD.addEventListener("click", mange(x+1,y+1));
                }

                if (!caseG.firstChild) {
                    caseG.style.backgroundColor = "blue";
                    caseG.addEventListener("click", moove);
                } else if (caseG.firstChild && caseG.firstChild.classList.contains("pion-blanc")) {
                    caseG = document.querySelector(`[data-x="${x - 2}"][data-y="${y + 2}"]`).style.backgroundColor = "blue";
                    caseG.addEventListener("click", mange(x-1,y+1));
                }
            }

        } else {
            if (x == 0) {
                caseD = document.querySelector(`[data-x="${x + 1}"][data-y="${y - 1}"]`);
                if (!caseD.firstChild) {
                    caseD.style.backgroundColor = "blue";
                    caseD.addEventListener("click", moove);
                } else if (caseD.firstChild && caseD.firstChild.classList.contains("pion-noir")) {
                    caseD = document.querySelector(`[data-x="${x + 2}"][data-y="${y - 2}"]`).style.backgroundColor = "blue";
                    caseD.addEventListener("click", mange(x+1,y-1));
                }

            } else if (x == 9) {
                caseG = document.querySelector(`[data-x="${x - 1}"][data-y="${y - 1}"]`);
                if (!caseG.firstChild) {
                    caseG.style.backgroundColor = "blue";
                    caseG.addEventListener("click", moove);
                } else if (caseG.firstChild && caseG.firstChild.classList.contains("pion-noir")) {
                    caseG = document.querySelector(`[data-x="${x - 2}"][data-y="${y - 2}"]`).style.backgroundColor = "blue";
                    caseG.addEventListener("click", mange(x-1,y-1));
                }
            } else {
                caseD = document.querySelector(`[data-x="${x + 1}"][data-y="${y - 1}"]`);
                caseG = document.querySelector(`[data-x="${x - 1}"][data-y="${y - 1}"]`);
                if (!caseD.firstChild) {
                    caseD.style.backgroundColor = "blue";
                    caseD.addEventListener("click", moove);
                } else if (caseD.firstChild && caseD.firstChild.classList.contains("pion-noir")) {
                    caseD = document.querySelector(`[data-x="${x + 2}"][data-y="${y - 2}"]`).style.backgroundColor = "blue";
                    caseD.addEventListener("click", mange(x+1,y-1));
                }

                if (!caseG.firstChild) {
                    caseG.style.backgroundColor = "blue";
                    caseG.addEventListener("click", moove);
                } else if (caseG.firstChild && caseG.firstChild.classList.contains("pion-noir")) {
                    caseG = document.querySelector(`[data-x="${x - 2}"][data-y="${y - 2}"]`).style.backgroundColor = "blue";
                    caseG.addEventListener("click", mange(x-1,y-1));
                }
            }
        }
    }
}








function mme() {
    var blanc =document.getElementsByClassName("pion-blanc")
    for (let elem of blanc) {
        elem.style.backgroundColor="rgb(255,105,180)"
        
    }
}

document.getElementById("switch").addEventListener("click",mme,false);

