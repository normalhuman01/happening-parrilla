const inputFecha = document.getElementById("fechas");

const contenedor_fechas = document.querySelector(".contenedor_fechas");
const formulario = document.querySelector("form");


function addEvent(){
    for(let i = 0; i < contenedor_fechas.childElementCount;i++){
        let hijo = contenedor_fechas.children[i];

        hijo.addEventListener("click",(e)=>{
            let contenedor = e.currentTarget;
            let fecha = contenedor.id;

            inputFecha.value = fecha;

            formulario.submit();
        })
    }
}

addEvent();