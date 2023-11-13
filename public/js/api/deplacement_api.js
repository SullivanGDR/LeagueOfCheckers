const API_URL = "https://s3-4672.nuage-peda.fr/Damier/public/api/deplacements";

async function createDeplacement(idMouvement,idPartie, emplacementX, emplacementY, arriveX, arriveY) {
    try {
        const data = {
            "emplacementX": emplacementX,
            "emplacementY": emplacementY,
            "arriveX": arriveX,
            "arriveY": arriveY,
            "mouvement": `/Damier/public/api/mouvements/${idMouvement}`,
            "parties": [
                `/Damier/public/api/parties/${idPartie}`
              ]
        };

        //création des options de la requête
        const options = {
            method: 'POST', // Méthode HTTP
            body: JSON.stringify(data),
            headers: {
                'Content-Type': 'application/ld+json',
                'Accept': 'application/ld+json',
            },
        };

        const response = await fetch(`${API_URL}`, options);
        if (!response.ok) {
            throw new Error('Erreur :' + response.statusText);
            //on va nous afficher l'erreur qu'on nous a retourner
        }
        const r = await response.json();
        console.log(r);
        return r;
    }
    catch (erreur) {
        console.error('Erreur lors de lauthentification: ', erreur);
        throw erreur;
        //throw erreur -> on va franchir l'erreur sans que le reste sois perturber
    }
}

export {createDeplacement}