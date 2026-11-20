/**
 * Helper para consumo da API REST do sistema
 */
const API = {
    baseUrl: '/school-system/app/api/',

    async request(method, endpoint, data = null) {
        const headers = {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + (localStorage.getItem('api_token') || '')
        };
        const config = { method, headers };
        if (data) config.body = JSON.stringify(data);

        const response = await fetch(this.baseUrl + endpoint, config);
        const result = await response.json();
        if (!response.ok) throw new Error(result.error || 'Erro na API');
        return result;
    },

    login: (email, senha) => API.request('POST', 'auth.php', {email, senha}),
    getHorarios: () => API.request('GET', 'alunos.php?action=horarios'),
    getBoletim: () => API.request('GET', 'alunos.php?action=boletim'),
    getFaltas: () => API.request('GET', 'alunos.php?action=faltas'),
    registrarChamada: (data) => API.request('POST', 'professores.php', {action:'chamada', ...data}),
    lancarNotas: (data) => API.request('POST', 'professores.php', {action:'notas', ...data})
};