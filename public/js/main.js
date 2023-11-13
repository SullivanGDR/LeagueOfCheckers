import { createDeplacement } from "./api/deplacement_api.js";
import { getMouvement,createMouvement,patchArriveMouvement } from "./api/mouvement_api.js";
import { patchEtatPlateau,getNbCoupJN,getNbCoupJB,patchAddNbCoupJN,patchAddNbCoupJB,getNbTour,patchAddNbTour,getNbPionJB,getNbPionJN,patchDellNbPionJB,patchDellNbPionJN,getEtatPlateau } from "./api/partie_api.js";
import { createDamier } from "./damier.js";

createDamier();

// // Booléen pour contrôler le chronomètre
// let isRunning = false;
// let startTime = null;

// // Fonction pour formater un nombre en ajoutant un zéro initial si nécessaire
// function formatNumberWithLeadingZero(number) {
//   return number.toString().padStart(2, '0');
// }

// // Fonction pour mettre à jour l'affichage du chronomètre
// function updateChronometer() {
//   if (isRunning) {
//     const currentTime = new Date();
//     const elapsedTime = new Date(currentTime - startTime);
//     const minutes = formatNumberWithLeadingZero(elapsedTime.getUTCMinutes());
//     const seconds = formatNumberWithLeadingZero(elapsedTime.getUTCSeconds());
//     console.log(`Temps écoulé : ${minutes}:${seconds}`);
//   }
// }

// // Mettre à jour le chronomètre toutes les 1 seconde
// const chronometerInterval = setInterval(updateChronometer, 1000);

// // Démarrer le chronomètre
// function startChronometer() {
//   if (!isRunning) {
//     startTime = new Date();
//     isRunning = true;
//   }
// }

// // Arrêter le chronomètre
// function stopChronometer() {
//   if (isRunning) {
//     isRunning = false;
//   }
// }

// // Exemple pour démarrer le chronomètre
// startChronometer();

// // Exemple pour arrêter le chronomètre après 3 minutes (180 secondes)
// setTimeout(() => {
//   stopChronometer();
// }, 180000);
