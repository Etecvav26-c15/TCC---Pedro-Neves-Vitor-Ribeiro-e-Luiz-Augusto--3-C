// Validação de formulários
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', e => {
            const inputs = form.querySelectorAll('[required]');
            let valid = true;
            inputs.forEach(inp => {
                if (!inp.value.trim()) {
                    inp.classList.add('error');
                    valid = false;
                } else inp.classList.remove('error');
            });
            if (!valid) {
                e.preventDefault();
                alert('Preencha todos os campos obrigatórios.');
            }
        });
    });
});

// Função para chamadas à API (se necessário)
async function apiFetch(url, options = {}) {
    const token = localStorage.getItem('api_token');
    const res = await fetch('/school-system/app/api/' + url, {
        ...options,
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + token,
            ...options.headers
        }
    });
    return res.json();
}