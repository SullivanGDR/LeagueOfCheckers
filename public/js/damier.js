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

        const caseChoisis = pionS.parentElement;
        const x = parseInt(caseChoisis.dataset.x);
        const y = parseInt(caseChoisis.dataset.y);

        function processCase(dx, dy) {
            const targetX = x + dx;
            const targetY = y + dy;

            const targetCase = document.querySelector(`[data-x="${targetX}"][data-y="${targetY}"]`);

            if (targetCase && !targetCase.firstChild) {
                targetCase.style.backgroundColor = "blue";
                targetCase.addEventListener("click", moove);
            } else if (targetCase && targetCase.firstChild) {
                const jumpTarget = document.querySelector(`[data-x="${targetX + dx}"][data-y="${targetY + dy}"]`);
                if (jumpTarget && !jumpTarget.firstChild) {
                    jumpTarget.style.backgroundColor = "blue";
                    jumpTarget.addEventListener("click", function () {
                        moove();
                        let caseClear = document.querySelector(`[data-x="${targetX}"][data-y="${targetY}"]`);
                        if (caseClear) {
                            console.log(caseClear);
                            let pion = caseClear.firstChild;
                            if (pion) {
                                caseClear.removeChild(pion);
                            }
                        }
                    });
                }
            }
        }

        if (pionS.classList.contains("pion-noir")) {
            if (x === 0 || x === 9) {
                // Handle corner cases
                processCase(1, 1);
            } else {
                processCase(1, 1);
                processCase(-1, 1);
            }
        } else if (pionS.classList.contains("pion-blanc")) {
            if (x === 0 || x === 9) {
                // Handle corner cases
                processCase(1, -1);
            } else {
                processCase(1, -1);
                processCase(-1, -1);
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

// function mange(x, y) {
//     moove();
//     let caseClear = document.querySelector(`[data-x="${x}"][data-y="${y}"]`);
//     if (caseClear) {
//         console.log(caseClear);
//         let pion = caseClear.firstChild;
//         if (pion) {
//             caseClear.removeChild(pion);
//         }
//     }
// }
