const form = document.querySelector("form");
const contenedorHorarios = document.querySelector(".contenedor_horarios");

const inputHorario = document.getElementById("horario");


function addEvent(){
    for(let i = 0; i < contenedorHorarios.childElementCount;i++){
        let hijo = contenedorHorarios.children[i];

        hijo.addEventListener("click",(e)=>{
            e.currentTarget;
            
            checkRepeatSelected(contenedorHorarios,e.currentTarget);

            if(e.currentTarget.classList.contains("horario_selected")){
                console.log(e.currentTarget);
                inputHorario.value = "";
                e.currentTarget.classList.remove("horario_selected");
            }
            else{
                //añadimos el valor al input
                const horarioP = e.currentTarget.firstElementChild;
                const valor = horarioP.textContent;
    
                inputHorario.value = valor;
                
                e.currentTarget.classList.add("horario_selected");

            }
        })
    }
}

// en caso de que haya dos input seleccionados removemos la clase selected
function checkRepeatSelected(contenedorHorarios,selected){
    for(let i = 0; i < contenedorHorarios.childElementCount;i++){
        let hijo = contenedorHorarios.children[i];

        if(hijo != selected){
            hijo.classList.remove("horario_selected");
        }
    }
}

addEvent();