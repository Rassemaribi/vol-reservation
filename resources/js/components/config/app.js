import axios from 'axios';

const api = axios.create({
  baseURL: 'http://localhost:8000', // Assurez-vous que l'URL est correcte
});

export default api;