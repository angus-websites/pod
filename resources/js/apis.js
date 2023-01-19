import axios from 'axios';

// TODO updated this for deployment
export const PodApi = axios.create({
    baseURL: `http://127.0.0.1:8000/api`,
})
