import { validarCPF } from "./validarCPF.js";


const form = document.getElementById("formulario");
const nome = document.getElementById("nome");
const cpfInput = document.getElementById("cpf");
const data = document.getElementById("data");
const nomeResp = document.getElementById("nomeResp");
const cpfResp = document.getElementById("cpfResp");
const curso = document.getElementById("selectCurso");


form.addEventListener("submit", (ev) => {
    const nameValid = validateName()
    const cpfValid = validateCPF(cpfInput)
    const cpfRespValid = validateCPF(cpfResp)
    const dataValid = validateData()
    const nomeRespValid = validateNomeResp()
    const cursoValid = validateCurso()



    const formVald = nameValid && cpfValid && cpfRespValid && dataValid && nomeRespValid && cursoValid

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
nomeResp.addEventListener("input", (ev) => {
    ev.preventDefault();
    validateNomeResp()
});
data.addEventListener("input", (ev) => {
    ev.preventDefault();
    validateData()
});

cpfResp.addEventListener("input", (ev) => {
    ev.preventDefault();
    maskCPF(cpfResp)
    validateCPF(cpfResp)
});

curso.addEventListener("click", () => {
    curso.addEventListener("change", () => {
        validateCurso()
        document.getElementById("curso").value = curso.value;

    }
    )
});

function validateCurso(){
    const cursoValue = curso.value
    if(cursoValue === "0") {
        errorInput(curso, "É obrigatorio selecionar um curso")
        return false
    }else{
        const select = curso.parentElement
        select.className = "selectErro"
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

function validateNomeResp(){
    const nomeRespValue = nomeResp.value

    if(nomeRespValue === "") {
        errorInput(nomeResp, "Nome do Responsavel é obrigatório.")
        return false
    }else{
        const formItem = nomeResp.parentElement
        formItem.className = "formInput"
        return true
    }
}


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

