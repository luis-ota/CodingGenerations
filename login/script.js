// Função para validar o formulário de login
function validarFormulario(usuario, senha) {
    // Validar se o campo de usuário não está vazio
    if (!usuario.trim()) {
        alert('Por favor, insira um nome de usuário.');
        return false;
    }

    // Validar se o campo de senha não está vazio
    if (!senha.trim()) {
        alert('Por favor, insira uma senha.');
        return false;
    }

    // Outras validações podem ser adicionadas conforme necessário

    return true;
}

// Adiciona um ouvinte de evento ao formulário de login
document.getElementById('login').addEventListener('submit', function (event) {
    // Obtém os valores dos campos de usuário e senha
    const usuarioInput = document.getElementById('usuario');
    const senhaInput = document.getElementById('senha');

    const usuarioValue = usuarioInput.value;
    const senhaValue = senhaInput.value;

    // Valida o formulário
    if (!validarFormulario(usuarioValue, senhaValue)) {
        event.preventDefault(); // Impede o envio do formulário se houver erros
    }
});
