// public/assets/frontend/js/api-client.js
window.apiClient = axios.create({
    baseURL: '/api/v1',
    headers: { 'Accept': 'application/json' },
});
