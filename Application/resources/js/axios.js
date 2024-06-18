import axios from 'axios';

const axiosInstance = axios.create({
    baseURL: 'http://localhost:8000/api',
    timeout: 1000,
    headers: {
        'Content-Type': 'application/json'
    }
});

axiosInstance.interceptors.response.use(
    response => response,
    error => {
      // Vérifier si c'est une erreur de réponse
      if (error.response) {
        // Gérer les erreurs 404
        if (error.response.status === 400) {
          error.message = 'Ressource non trouvée';
        }
        // Vous pouvez ajouter d'autres statuts d'erreur ici
        else {
          error.message = `Erreur: ${error.response.status} - ${error.response.statusText}`;
        }
      } else {
        // Gérer les erreurs sans réponse
        error.message = 'Aucune réponse reçue du serveur';
      }
      return Promise.reject(error);
    }
  );
  


export default axiosInstance;

