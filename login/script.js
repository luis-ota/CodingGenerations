function validarFormulario(usuario, senha) {
    if (!usuario.trim()) {
        alert('Por favor, insira um nome de usuário.');
        return false;
    }

    if (!senha.trim()) {
        alert('Por favor, insira uma senha.');
        return false;
    }


    return true;
}

document.getElementById('login').addEventListener('submit', function (event) {
    const usuarioInput = document.getElementById('usuario');
    const senhaInput = document.getElementById('senha');

    const usuarioValue = usuarioInput.value;
    const senhaValue = senhaInput.value;

    if (!validarFormulario(usuarioValue, senhaValue)) {
        event.preventDefault();
    }
});
