const API_URL ="https://s3-4672.nuage-peda.fr/Damier6.3/public/api/mouvements";

async function getMouvement(idPartie) {
    try {
        const reponse = await fetch(`${API_URL}?page=${page}&order%5Bnom%5D=asc`);
        if (!reponse.ok) {
            throw new Error('Erreur : '+reponse.statusText);
        }
        const data = await reponse.json();
        return data;
    } catch (error) {
        console.error('Erreur lors de la reception : ',error);
        throw error;
    }
}