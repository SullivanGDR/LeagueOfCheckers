import { createDeplacement } from "./api/deplacement_api.js";
import { getMouvement,createMouvement,patchArriveMouvement,getMouvementId } from "./api/mouvement_api.js";
import { patchEtatPlateau,getNbCoupJN,getNbCoupJB,patchAddNbCoupJN,patchAddNbCoupJB,getNbTour,patchAddNbTour,getNbPionJB,getNbPionJN,patchDellNbPionJB,patchDellNbPionJN,getEtatPlateau,getJoueurN,getJoueurB } from "./api/partie_api.js";
export {createDamier}

var pionS=null;
var caseMove=null;
var partie=document.getElementById('idPartie');
var tour= await getNbTour(partie.dataset.idpartie)
init()
canPlay()
console.log(tour)
setInterval(fullReset, 10000);


async function init() {
    if (await getEtatPlateau(partie.dataset.idpartie) == null) {
        createDamier();
        initPion();
        recursiv();
    }else{
        tour = await getNbTour(partie.dataset.idpartie)
        document.getElementById('damier').innerHTML=await getEtatPlateau(partie.dataset.idpartie);
        initPion();
        resetMouvement();
    }

}

async function recursiv(){
    if (await getJoueurB(partie.dataset.idpartie)==null) {
        recursiv();
    }else{
        await patchAddNbTour(partie.dataset.idpartie);
        tour = await getNbTour(partie.dataset.idpartie)
    }
}

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
                        
                        newDiv.appendChild(pion);
                    } else if (i >= 6) {
                        let pion = document.createElement("span");
                        pion.classList.add("pion-blanc");
                        
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
                        
                        newDiv.appendChild(pion);
                    } else if (i >= 6) {
                        let pion = document.createElement("span");
                        pion.classList.add("pion-blanc");
                        
                        newDiv.appendChild(pion);
                    }
                    damier.appendChild(newDiv);
                }
            }
        }
    }
    initPion();
}

async function fullReset() {
    if (tour == 0) {
        document.getElementById('damier').style.pointerEvents = 'none';
    }else{
        tour=await getNbTour(parseInt(partie.dataset.idpartie))
        canPlay()
        resetMouvement()
        document.getElementById('damier').innerHTML=await getEtatPlateau(partie.dataset.idpartie)
        
        initPion()
    }
}

function resetBorderPion() {
    let damier = document.getElementById('damier')
    for (let pion of damier.children) {
        
        
    }
}

async function resetMouvement() {
    let mouvements = await getMouvement(partie.dataset.idpartie);
    let divMouv = document.getElementById("mouvement");
    divMouv.innerHTML="";
    for (let mouv of mouvements) {
        let p = document.createElement("p");
        p.classList.add("text-white");
        p.classList.add("text-center");
        p.classList.add("p-2");
        p.style.backgroundColor = "rgba(31, 41, 55)";
        p.style.borderRadius = "16px";
        const emplacementX = encodeURIComponent(mouv.emplacementX);
        const emplacementY = encodeURIComponent(mouv.emplacementY);
        const arriveX = encodeURIComponent(mouv.arriveX);
        const arriveY = encodeURIComponent(mouv.arriveY);
        if (mouv.joueur.id==await getJoueurN(partie.dataset.idpartie)) {
            p.innerHTML = `Déplacement du joueur Noir : [${emplacementX},${emplacementY}] <i class="bi bi-arrow-right"></i> [${arriveX},${arriveY}]`;
        }else if (mouv.joueur.id==await getJoueurB(partie.dataset.idpartie)) {
            p.innerHTML = `Déplacement du joueur Blanc : [${emplacementX},${emplacementY}] <i class="bi bi-arrow-right"></i> [${arriveX},${arriveY}]`;
        }
        divMouv.appendChild(p);
    }
}


async function initPion() {
    if (partie.dataset.idjoueur==await getJoueurN(partie.dataset.idpartie)) {
        let pionN=document.getElementsByClassName('pion-noir');
        for (let pion of pionN) {
            pion.addEventListener("click", select);
            pion.addEventListener("click", selectCase); 
        }
    }else if (partie.dataset.idjoueur==await getJoueurB(partie.dataset.idpartie)) {
        let pionB=document.getElementsByClassName('pion-blanc');
        for (let pion of pionB) {
            pion.addEventListener("click", select);
            pion.addEventListener("click", selectCase); 
        }
    }
}

async function canPlay() {
    if (partie.dataset.idjoueur==await getJoueurN(partie.dataset.idpartie) && tour%2==0) {
        document.getElementById('damier').style.pointerEvents = 'none';
    }else if (partie.dataset.idjoueur==await getJoueurB(partie.dataset.idpartie) && tour%2!=0) {
        document.getElementById('damier').style.pointerEvents = 'none';
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

async function moove() {
    if (pionS !== null) {
        let caseChoisis = this
        //console.log(caseChoisis)
        if (caseChoisis.style.backgroundColor == "blue") {
            pionS.parentElement.removeChild(pionS);
            caseChoisis.appendChild(pionS);
            resetCase();
            await patchAddNbTour(parseInt(partie.dataset.idpartie))
            tour=await getNbTour(parseInt(partie.dataset.idpartie))
            canPlay();
            let departX=pionS.parentElement.dataset.x
            let departY=pionS.parentElement.dataset.y
            let idMouv=await createMouvement(parseInt(departX),parseInt(departY),parseInt(partie.dataset.idjoueur),"simple")
            createDeplacement(parseInt(idMouv),parseInt(partie.dataset.idpartie),parseInt(departX),parseInt(departY),parseInt(caseChoisis.dataset.x),parseInt(caseChoisis.dataset.y))
            patchArriveMouvement(parseInt(idMouv),parseInt(caseChoisis.dataset.x),parseInt(caseChoisis.dataset.y))
            patchEtatPlateau(parseInt(partie.dataset.idpartie),document.getElementById('damier').innerHTML)
            console.log(tour)
            resetSelectPion();
            console.log(document.getElementById('damier'))
        }
    }
}

async function moove2() {
    if (pionS !== null) {
        let caseChoisis = caseMove
        //console.log(caseChoisis)
        if (caseChoisis.style.backgroundColor == "blue") {
            pionS.parentElement.removeChild(pionS);
            caseChoisis.appendChild(pionS);
            resetCase();
            await patchAddNbTour(parseInt(partie.dataset.idpartie))
            tour=await getNbTour(parseInt(partie.dataset.idpartie))
            canPlay();
            let departX=pionS.parentElement.dataset.x
            let departY=pionS.parentElement.dataset.y
            let idMouv=await createMouvement(parseInt(departX),parseInt(departY),parseInt(partie.dataset.idjoueur),"saut")
            createDeplacement(parseInt(idMouv),parseInt(partie.dataset.idpartie),parseInt(departX),parseInt(departY),parseInt(caseChoisis.dataset.x),parseInt(caseChoisis.dataset.y))
            patchArriveMouvement(parseInt(idMouv),parseInt(caseChoisis.dataset.x),parseInt(caseChoisis.dataset.y))
            patchEtatPlateau(parseInt(partie.dataset.idpartie),document.getElementById('damier').innerHTML)
            console.log(tour)
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
                console.log("coucou")
                console.log(targetCase);
                targetCase.addEventListener("click", moove);
            } else if (targetCase && targetCase.firstChild && (pionS.classList.contains("pion-blanc") && !targetCase.firstChild.classList.contains("pion-blanc")) ||
            (pionS.classList.contains("pion-noir") && !targetCase.firstChild.classList.contains("pion-noir")) ) {
                const jumpTarget = document.querySelector(`[data-x="${targetX + dx}"][data-y="${targetY + dy}"]`);
                if (jumpTarget && !jumpTarget.firstChild) {
                    jumpTarget.style.backgroundColor = "blue";
                    jumpTarget.addEventListener("click", function () {
                        caseMove=this;
                        moove2();
                        
                        let caseClear = document.querySelector(`[data-x="${targetX}"][data-y="${targetY}"]`);
                        if (caseClear) {
                            console.log("coucou2")
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
        console.log("=========");
        if (pionS.classList.contains("pion-noir")) {
            if (x === 0) {
                // Handle corner cases
                processCase(1, 1);
            }else if (x === 9) {
                processCase(-1, 1);
            } else {
                processCase(1, 1);
                processCase(-1, 1);
            }
        } else if (pionS.classList.contains("pion-blanc")) {
            if (x === 0) {
                // Handle corner cases
                processCase(1, -1);
            }else if (x === 9) {
                processCase(-1, -1);
            } else {
                processCase(1, -1);
                processCase(-1, -1);
            }
        }
        console.log("=========");
    }
}
