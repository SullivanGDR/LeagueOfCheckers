export{getNbVictoireJoueur,patchNbVictoireJoueur,getNbDefaiteJoueur,patchNbDefaiteJoueur,getNbPartieJoueur,patchNbPartieJoueur,getMonnaieJoueur,patchMonnaieJoueur,getPointsRangJoueur,patchPointsRangJoueur}
const API_URL = "https://s3-4672.nuage-peda.fr/Damier/public/api/joueurs";


async function getNbVictoireJoueur(idJoueur) {
    try {
        const reponse = await fetch(`${API_URL}/${idJoueur}`);
        if (!reponse.ok) {
            throw new Error('Erreur : '+reponse.statusText);
        }
        const data = await reponse.json();
        return data.nbVictoire;
    } catch (error) {
        console.error('Erreur lors de la reception : ',error);
        throw error;
    }
}


async function patchNbVictoireJoueur(idJoueur) {
    try {
        const data = {
            "nbVictoire": parseInt(await getNbVictoireJoueur(idJoueur))+1,
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

        const response = await fetch(`${API_URL}/${idJoueur}`, options);
        if (!response.ok) {
            throw new Error('Erreur :' + response.statusText);
            //on va nous afficher l'erreur qu'on nous a retourner
        }
        const r = await response.json();
        //console.log(r);
        return r;
    }
    catch (erreur) {
        console.error('Erreur lors de lauthentification: ', erreur);
        throw erreur;
        //throw erreur -> on va franchir l'erreur sans que le reste sois perturber
    }
}

async function getNbDefaiteJoueur(idJoueur) {
    try {
        const reponse = await fetch(`${API_URL}/${idJoueur}`);
        if (!reponse.ok) {
            throw new Error('Erreur : '+reponse.statusText);
        }
        const data = await reponse.json();
        return data.nbDefaite;
    } catch (error) {
        console.error('Erreur lors de la reception : ',error);
        throw error;
    }
}


async function patchNbDefaiteJoueur(idJoueur) {
    try {
        const data = {
            "nbDefaite": parseInt(await getNbDefaiteJoueur(idJoueur))+1,
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

        const response = await fetch(`${API_URL}/${idJoueur}`, options);
        if (!response.ok) {
            throw new Error('Erreur :' + response.statusText);
            //on va nous afficher l'erreur qu'on nous a retourner
        }
        const r = await response.json();
        //console.log(r);
        return r;
    }
    catch (erreur) {
        console.error('Erreur lors de lauthentification: ', erreur);
        throw erreur;
        //throw erreur -> on va franchir l'erreur sans que le reste sois perturber
    }
}

async function getNbPartieJoueur(idJoueur) {
    try {
        const reponse = await fetch(`${API_URL}/${idJoueur}`);
        if (!reponse.ok) {
            throw new Error('Erreur : '+reponse.statusText);
        }
        const data = await reponse.json();
        return data.nbTotalePartie;
    } catch (error) {
        console.error('Erreur lors de la reception : ',error);
        throw error;
    }
}


async function patchNbPartieJoueur(idJoueur) {
    try {
        const data = {
            "nbTotalePartie": parseInt(await getNbPartieJoueur(idJoueur))+1,
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

        const response = await fetch(`${API_URL}/${idJoueur}`, options);
        if (!response.ok) {
            throw new Error('Erreur :' + response.statusText);
            //on va nous afficher l'erreur qu'on nous a retourner
        }
        const r = await response.json();
        //console.log(r);
        return r;
    }
    catch (erreur) {
        console.error('Erreur lors de lauthentification: ', erreur);
        throw erreur;
        //throw erreur -> on va franchir l'erreur sans que le reste sois perturber
    }
}

async function getMonnaieJoueur(idJoueur) {
    try {
        const reponse = await fetch(`${API_URL}/${idJoueur}`);
        if (!reponse.ok) {
            throw new Error('Erreur : '+reponse.statusText);
        }
        const data = await reponse.json();
        return data.monnaie;
    } catch (error) {
        console.error('Erreur lors de la reception : ',error);
        throw error;
    }
}


async function patchMonnaieJoueur(idJoueur,monnaie) {
    try {
        const data = {
            "monnaie": parseInt(await getMonnaieJoueur(idJoueur))+monnaie,
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

        const response = await fetch(`${API_URL}/${idJoueur}`, options);
        if (!response.ok) {
            throw new Error('Erreur :' + response.statusText);
            //on va nous afficher l'erreur qu'on nous a retourner
        }
        const r = await response.json();
        //console.log(r);
        return r;
    }
    catch (erreur) {
        console.error('Erreur lors de lauthentification: ', erreur);
        throw erreur;
        //throw erreur -> on va franchir l'erreur sans que le reste sois perturber
    }
}

async function getPointsRangJoueur(idJoueur) {
    try {
        const reponse = await fetch(`${API_URL}/${idJoueur}`);
        if (!reponse.ok) {
            throw new Error('Erreur : '+reponse.statusText);
        }
        const data = await reponse.json();
        return data.pointsRang;
    } catch (error) {
        console.error('Erreur lors de la reception : ',error);
        throw error;
    }
}


async function patchPointsRangJoueur(idJoueur,point) {
    try {
        const data = {
            "pointsRang": parseInt(await getPointsRangJoueur(idJoueur))+point,
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

        const response = await fetch(`${API_URL}/${idJoueur}`, options);
        if (!response.ok) {
            throw new Error('Erreur :' + response.statusText);
            //on va nous afficher l'erreur qu'on nous a retourner
        }
        const r = await response.json();
        //console.log(r);
        return r;
    }
    catch (erreur) {
        console.error('Erreur lors de lauthentification: ', erreur);
        throw erreur;
        //throw erreur -> on va franchir l'erreur sans que le reste sois perturber
    }
}