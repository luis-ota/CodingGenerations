document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('agendamento-form');
    const cpfInput = document.getElementById('cpf');
    const telefoneInput = document.getElementById('telefone');

    form.addEventListener('submit', function (event) {
   
        cpfInput.value = formatCPF(cpfInput.value);

     
        telefoneInput.value = formatTelefone(telefoneInput.value);

        if (!validateCPF(cpfInput.value)) {
            alert('CPF inválido. Por favor, insira um CPF válido.');
            event.preventDefault();
        }
    });

    function formatCPF(cpf) {
        cpf = cpf.replace(/[^\d]/g, '');
        return cpf.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, '$1.$2.$3-$4');
    }

    function formatTelefone(telefone) {
        telefone = telefone.replace(/[^\d]/g, '');
        return telefone.replace(/(\d{2})(\d{4,5})(\d{4})/, '($1) $2-$3');
    }

    function validateCPF(cpf) {
        const cpfRegex = /^(\d{3}\.\d{3}\.\d{3}-\d{2}|\d{11})$/;

        if (!cpfRegex.test(cpf)) {
            return false;
        }
        cpf = cpf.replace(/[^\d]/g, '');
        let sum = 0;

        for (let i = 0; i < 9; i++) {
            sum += parseInt(cpf.charAt(i)) * (10 - i);
        }

        const remainder = (sum * 10) % 11;

        if (remainder === 10 || remainder === 11) {
            if (parseInt(cpf.charAt(9)) !== 0) {
                return false;
            }
        } else {
            if (parseInt(cpf.charAt(9)) !== remainder) {
                return false;
            }
        }

        sum = 0;
        for (let i = 0; i < 10; i++) {
            sum += parseInt(cpf.charAt(i)) * (11 - i);
        }

        const secondRemainder = (sum * 10) % 11;

        if (secondRemainder === 10 || secondRemainder === 11) {
            if (parseInt(cpf.charAt(10)) !== 0) {
                return false;
            }
        } else {
            if (parseInt(cpf.charAt(10)) !== secondRemainder) {
                return false;
            }
        }

        return true;
    }
});