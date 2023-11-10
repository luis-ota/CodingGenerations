export function validarCPF(cpf) {
    // Remover caracteres não numéricos
    cpf = cpf.replace(/[^\d]/g, '');
  
    // Verificar se o CPF tem 11 dígitos
    if (cpf.length !== 11) {
      return false;
    }
  
    // Verificar se todos os dígitos são iguais
    if (/^(\d)\1{10}$/.test(cpf)) {
      return false;
    }
  
    // Calcular o primeiro dígito verificador
    let soma = 0;
    for (let i = 0; i < 9; i++) {
      soma += parseInt(cpf.charAt(i)) * (10 - i);
    }
    let digito1 = 11 - (soma % 11);
    if (digito1 > 9) {
      digito1 = 0;
    }
  
    // Verificar se o primeiro dígito verificador está correto
    if (parseInt(cpf.charAt(9)) !== digito1) {
      return false;
    }
  
    // Calcular o segundo dígito verificador
    soma = 0;
    for (let i = 0; i < 10; i++) {
      soma += parseInt(cpf.charAt(i)) * (11 - i);
    }
    let digito2 = 11 - (soma % 11);
    if (digito2 > 9) {
      digito2 = 0;
    }
  
    // Verificar se o segundo dígito verificador está correto
    if (parseInt(cpf.charAt(10)) !== digito2) {
      return false;
    }
  
    // Se todas as verificações passaram, o CPF é válido
    return true;
  }

  