document.addEventListener("DOMContentLoaded", () => {
    // Todo tu código actual aquí adentro

let step = 0;
const steps = ["general_f", "detalles_f", "contacto_f"];

const nextBtn = document.getElementById("nextBtn");
const prevBtn = document.getElementById("prevBtn");
const btnText = document.getElementById("btn_send");

// Función para actualizar la vista
function updateForm() {
    // Ocultar todas las secciones
    steps.forEach((s) => {
        document.getElementById(s).style.display = "none";
    });

    // Mostrar la sección actual
    document.getElementById(steps[step]).style.display = "block";

    // Lógica del botón VOLVER (ocultar si estamos en el paso 0)
    prevBtn.style.display = (step === 0) ? "none" : "inline-block";

    // Lógica del botón SIGUIENTE / ENVIAR
    if (step === steps.length - 1) {
        btnText.innerText = "Enviar";
        nextBtn.type = "submit";
    } else {
        btnText.innerText = "Next";
        nextBtn.type = "button";
    }
}

// Evento Siguiente
nextBtn.addEventListener("click", (e) => {
    // Si ya estamos en el último paso, dejamos que el 'submit' ocurra
    if (step === steps.length - 1) return;

    // Si no, avanzamos
    if (step < steps.length - 1) {
        step++;
        updateForm();
    }
});

// Evento Volver
prevBtn.addEventListener("click", () => {
    if (step > 0) {
        step--;
        updateForm();
    }
});


// Tipo de oportunidad
document.getElementById("tipo").addEventListener("change", function(){
    let tipo = this.value;

    document.getElementById("campo_remuneracion").style.display = "none";
    document.getElementById("campo_salario").style.display = "none";
    document.getElementById("campo_visibilidad").style.display = "none";

    if(tipo === "pasantia"){
        document.getElementById("campo_remuneracion").style.display = "block";
        document.getElementById("campo_visibilidad").style.display = "block";
    }

    if(tipo === "trabajo"){
        document.getElementById("campo_salario").style.display = "block";
        document.getElementById("campo_visibilidad").style.display = "block";
    }
});


// Nivel estudiante
document.getElementById("nivel").addEventListener("change", function(){
    if(this.value === "estudiante"){
        document.getElementById("campo_anio").style.display = "block";
    } else {
        document.getElementById("campo_anio").style.display = "none";
    }
});







});

