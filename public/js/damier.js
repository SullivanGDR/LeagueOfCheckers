createDamier();

var pionS=null;

function createDamier(){
    var damier = document.getElementById('damier');
    for(var i = 0; i <= 9; i++){
        for (var y = 0; y <= 9; y++) {
            if (i % 2 == 0) {
                if(y % 2 == 0){
                    let newDiv = document.createElement("div");
                    newDiv.classList.add("case-noire");
                    if (i<=3) {
                        let pion = document.createElement("span");
                        pion.classList.add("pion-noir");
                        pion.addEventListener("click", select);
                        newDiv.appendChild(pion);
                    }else if (i>=6) {
                        let pion = document.createElement("span");
                        pion.classList.add("pion-blanc");
                        pion.addEventListener("click", select);
                        newDiv.appendChild(pion);
                    }
                    damier.appendChild(newDiv);
                } else {
                    let newDiv = document.createElement("div");
        
                    newDiv.classList.add("case-blanche");
        
                    damier.appendChild(newDiv);
                }  
            }
            else{
                if(y % 2 == 0){
                    let newDiv = document.createElement("div");
        
                    newDiv.classList.add("case-blanche");
        
                    damier.appendChild(newDiv);
                } else {
                    let newDiv = document.createElement("div");
                    newDiv.classList.add("case-noire");
                    if (i<=3) {
                        let pion = document.createElement("span");
                        pion.classList.add("pion-noir");
                        pion.addEventListener("click", select);
                        newDiv.appendChild(pion);
                    }else if (i>=6) {
                        let pion = document.createElement("span");
                        pion.classList.add("pion-blanc");
                        pion.addEventListener("click", select);
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
        pionS.classList.remove("surligne");
    }
    if (this != pionS) {
        pionS=this;
        this.classList.add("surligne");
    }else{
        pionS=null;
        this.classList.remove("surligne");
    }
    
}

