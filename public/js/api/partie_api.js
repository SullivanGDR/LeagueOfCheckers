const API_URL = "https://s3-4672.nuage-peda.fr/Damier/public/api/parties";

async function patchEtatPlateau(idPartie,plateau){
    try{
        const data = {
            "etatPlateau": [
                JSON.stringify(plateau)
            ],
          };

        //création des options de la requête
        const options = {
            method: 'PATCH', // Méthode HTTP
            body: JSON.stringify(data),
            headers: {
                'Content-Type': 'application/merge-patch+json',
                'Accept': 'application/ld+json',
            },
        };

        const response = await fetch(`${API_URL}/${idPartie}`,options);
        if(!response.ok){
            throw new Error('Erreur :'+ response.statusText);
            //on va nous afficher l'erreur qu'on nous a retourner
        }
        const r = await response.json();
        console.log(r);
        return r;
    }
    catch(erreur){
        console.error('Erreur lors de lauthentification: ',erreur);
        throw erreur;
        //throw erreur -> on va franchir l'erreur sans que le reste sois perturber
    }
}

async function getEtatPlateau(id) {
    try {
        const reponse = await fetch(`${API_URL}/${id}`);
        if (!reponse.ok) {
            throw new Error('Erreur : '+reponse.statusText);
        }
        const data = await reponse.json();
        console.log(JSON.parse(data.etatPlateau))
        return JSON.parse(data.etatPlateau);
    } catch (error) {
        console.error('Erreur lors de la reception : ',error);
        throw error;
    }
}

async function getNbCoupJN(id) {
    try {
        const reponse = await fetch(`${API_URL}/${id}`);
        if (!reponse.ok) {
            throw new Error('Erreur : '+reponse.statusText);
        }
        const data = await reponse.json();
        return data.nbCoupJN;
    } catch (error) {
        console.error('Erreur lors de la reception : ',error);
        throw error;
    }
}

async function getNbCoupJB(id) {
    try {
        const reponse = await fetch(`${API_URL}/${id}`);
        if (!reponse.ok) {
            throw new Error('Erreur : '+reponse.statusText);
        }
        const data = await reponse.json();
        return data.nbCoupJB;
    } catch (error) {
        console.error('Erreur lors de la reception : ',error);
        throw error;
    }
}

async function getNbTour(id) {
    try {
        const reponse = await fetch(`${API_URL}/${id}`);
        if (!reponse.ok) {
            throw new Error('Erreur : '+reponse.statusText);
        }
        const data = await reponse.json();
        return data.nbTour;
    } catch (error) {
        console.error('Erreur lors de la reception : ',error);
        throw error;
    }
}

async function patchAddNbCoupJN(idPartie) {
    try {
        const currentNbCoupJN = await getNbCoupJN(idPartie);

        const data = {
            nbCoupJN: currentNbCoupJN + 1,
        };

        // Création des options de la requête
        const options = {
            method: 'PATCH', // Méthode HTTP
            body: JSON.stringify(data),
            headers: {
                'Content-Type': 'application/merge-patch+json',
                'Accept': 'application/ld+json',
            },
        };

        const response = await fetch(`${API_URL}/${idPartie}`, options);
        if (!response.ok) {
            throw new Error('Erreur :' + response.statusText);
        }

        const r = await response.json();
        //console.log(r);
        return r;
    } catch (erreur) {
        console.error('Erreur lors de la modification : ', erreur);
        throw erreur;
    }
}

async function patchAddNbCoupJB(idPartie) {
    try {
        const currentNbCoupJB = await getNbCoupJB(idPartie);

        const data = {
            nbCoupJB: currentNbCoupJB + 1,
        };

        // Création des options de la requête
        const options = {
            method: 'PATCH', // Méthode HTTP
            body: JSON.stringify(data),
            headers: {
                'Content-Type': 'application/merge-patch+json',
                'Accept': 'application/ld+json',
            },
        };

        const response = await fetch(`${API_URL}/${idPartie}`, options);
        if (!response.ok) {
            throw new Error('Erreur :' + response.statusText);
        }

        const r = await response.json();
        //console.log(r);
        return r;
    } catch (erreur) {
        console.error('Erreur lors de la modification : ', erreur);
        throw erreur;
    }
}

async function patchAddNbTour(idPartie) {
    try {
        const currentNbTour = await getNbTour(idPartie);

        const data = {
            nbTour: currentNbTour + 1,
        };

        // Création des options de la requête
        const options = {
            method: 'PATCH', // Méthode HTTP
            body: JSON.stringify(data),
            headers: {
                'Content-Type': 'application/merge-patch+json',
                'Accept': 'application/ld+json',
            },
        };

        const response = await fetch(`${API_URL}/${idPartie}`, options);
        if (!response.ok) {
            throw new Error('Erreur :' + response.statusText);
        }

        const r = await response.json();
        //console.log(r);
        return r;
    } catch (erreur) {
        console.error('Erreur lors de la modification : ', erreur);
        throw erreur;
    }
}

async function getNbPionJB(id) {
    try {
        const reponse = await fetch(`${API_URL}/${id}`);
        if (!reponse.ok) {
            throw new Error('Erreur : '+reponse.statusText);
        }
        const data = await reponse.json();
        return data.nbPionB;
    } catch (error) {
        console.error('Erreur lors de la reception : ',error);
        throw error;
    }
}

async function getNbPionJN(id) {
    try {
        const reponse = await fetch(`${API_URL}/${id}`);
        if (!reponse.ok) {
            throw new Error('Erreur : '+reponse.statusText);
        }
        const data = await reponse.json();
        return data.nbPionN;
    } catch (error) {
        console.error('Erreur lors de la reception : ',error);
        throw error;
    }
}

async function patchDellNbPionJB(idPartie) {
    try {
        const currentNbPionJB = await getNbPionJB(idPartie);

        const data = {
            nbPionB: currentNbPionJB - 1,
        };

        // Création des options de la requête
        const options = {
            method: 'PATCH', // Méthode HTTP
            body: JSON.stringify(data),
            headers: {
                'Content-Type': 'application/merge-patch+json',
                'Accept': 'application/ld+json',
            },
        };

        const response = await fetch(`${API_URL}/${idPartie}`, options);
        if (!response.ok) {
            throw new Error('Erreur :' + response.statusText);
        }

        const r = await response.json();
        console.log(r);
        return r;
    } catch (erreur) {
        console.error('Erreur lors de la modification : ', erreur);
        throw erreur;
    }
}

async function patchDellNbPionJN(idPartie) {
    try {
        const currentNbPionJN = await getNbPionJN(idPartie);

        const data = {
            nbPionN: currentNbPionJN - 1,
        };

        // Création des options de la requête
        const options = {
            method: 'PATCH', // Méthode HTTP
            body: JSON.stringify(data),
            headers: {
                'Content-Type': 'application/merge-patch+json',
                'Accept': 'application/ld+json',
            },
        };

        const response = await fetch(`${API_URL}/${idPartie}`, options);
        if (!response.ok) {
            throw new Error('Erreur :' + response.statusText);
        }

        const r = await response.json();
        console.log(r);
        return r;
    } catch (erreur) {
        console.error('Erreur lors de la modification : ', erreur);
        throw erreur;
    }
}

export {patchEtatPlateau,getNbCoupJN,getNbCoupJB,patchAddNbCoupJN,patchAddNbCoupJB,getNbTour,patchAddNbTour,getNbPionJB,getNbPionJN,patchDellNbPionJB,patchDellNbPionJN,getEtatPlateau}



