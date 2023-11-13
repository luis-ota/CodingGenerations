import { validarCPF } from "../../cadastro_aluno/validarCPF.js";


const form = document.getElementById("formulario");
const nome = document.getElementById("nome");
const cpfInput = document.getElementById("cpf");
const data = document.getElementById("data");



form.addEventListener("submit", (ev) => {
    const nameValid = validateName()
    const cpfValid = validateCPF(cpfInput)
    const dataValid = validateData()


    const formVald = nameValid && cpfValid && dataValid

    if (!formVald) {
        ev.preventDefault();
    }
});

cpfInput.addEventListener("input", (ev) => {
    ev.preventDefault();
    maskCPF(cpfInput)
    validateCPF(cpfInput)
});

nome.addEventListener("input", (ev) => {
    ev.preventDefault();
    validateName()
});

data.addEventListener("input", (ev) => {
    ev.preventDefault();
    validateData()
});

function validateCPF(cpf){
    const cpfValue = cpf.value

    const valido = validarCPF(cpfValue)

    if (!valido) {
        errorInput(cpf, "Insira um CPF válido." )
        return false
    } else {
        const formItem = cpf.parentElement
        formItem.className = "formInput"
        return true
    }
}
function validateName(){
    const nomeValue = nome.value

    if(nomeValue === "") {
        errorInput(nome, "Nome é obrigatório.")
        return false
    }else{
        const formItem = nome.parentElement
        formItem.className = "formInput"
        return true
    }
}

function validateData(){
    const dataValue = data.value

    if(dataValue === "") {
        errorInput(data, "Data de nascimento é obrigatório.")
        return false
    }else{
        const formItem = data.parentElement
        formItem.className = "formInput"
        return true
    }
}

function errorInput(input, message){
    const formItem = input.parentElement
    const textMessage = formItem.querySelector("span")


    textMessage.innerText = message

    formItem.className = "formInput error"
}

function maskCPF(input) {
    let cpf = input.value

    cpf=cpf.replace(/\D/g,"")
    cpf=cpf.replace(/(\d{3})(\d)/,"$1.$2")
    cpf=cpf.replace(/(\d{3})(\d)/,"$1.$2")
    cpf=cpf.replace(/(\d{3})(\d{1,2})$/,"$1-$2")
    input.value = cpf

    input.setAttribute('maxlength', '14')
}
