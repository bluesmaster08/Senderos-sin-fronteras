document.addEventListener("DOMContentLoaded", function () {
  // Cuando el contenido del documento ha sido cargado, inicializa las validaciones
  initializeValidations();
});

function initializeValidations() {
  // Validación para el campo "Época Sugerida" usando una expresión regular
  addValidation(
    "epoca_sugerida",
    /^(primavera|verano|otoño|invierno)$/,
    "Época sugerida no válida. Debe ser una de las siguientes: primavera, verano, otoño, invierno."
  );

  // Validación para el campo "Actividades Populares" usando una expresión regular
  addValidation(
    "actividades_populares",
    /^(paseo en lancha|tour por la ciudad|recorrido del centro histórico|visita a museos|visita a acuarios)$/,
    "Actividad popular no válida. Debe ser una de las siguientes: paseo en lancha, tour por la ciudad, recorrido del centro histórico, visita a museos, visita a acuarios."
  );
}

function addValidation(elementId, regex, errorMessage) {
  // Añade un evento de validación al campo especificado
  document.getElementById(elementId).addEventListener("blur", function () {
    const value = this.value.toLowerCase();
    // Verifica si el valor del campo cumple con la expresión regular
    if (!regex.test(value)) {
      alert(errorMessage);
      // Si no cumple, muestra un mensaje de error y limpia el campo
      this.value = "";
    }
  });
}
