document.addEventListener("DOMContentLoaded", function () {
  // Muestra una alerta al cargar la página para indicar que el JavaScript está funcionando
  alert("JavaScript en el formulario aviones está funcionando!");

  // Selección de los campos por su ID
  const capacidadAsientosInput = document.getElementById("capacidad_asientos");
  const numeroSerieInput = document.getElementById("numero_serie");

  // Función para validar que el valor del campo esté dentro del rango especificado
  function validarRango(campo, min, max) {
    campo.addEventListener("blur", function () {
      const valor = parseInt(campo.value, 10); // Convierte el valor del campo a un número entero
      if (isNaN(valor) || valor < min || valor > max) {
        // Verifica si el valor no es un número o está fuera del rango
        alert(`Este campo debe tener un valor entre ${min} y ${max}.`); // Muestra una alerta si la validación falla
        campo.value = ""; // Limpia el campo para que el usuario ingrese un nuevo valor
      }
    });
  }

  // Llama a la función de validación para el campo de capacidad de asientos con un rango de 1 a 80
  validarRango(capacidadAsientosInput, 1, 80);

  // Nueva función para validar el número de serie alfanumérico de exactamente 10 caracteres
  function validarNumeroSerie() {
    numeroSerieInput.addEventListener("blur", function () {
      const numeroSerie = numeroSerieInput.value;

      // Validar que el número de serie sea alfanumérico y de exactamente 10 caracteres
      const regex = /^[a-zA-Z0-9]{10}$/; // Expresión regular para validar que el número de serie sea alfanumérico y de 10 caracteres
      if (!regex.test(numeroSerie)) {
        // Verifica si el número de serie no cumple con la expresión regular
        alert(
          "El número de serie debe ser un valor alfanumérico de exactamente 10 caracteres."
        ); // Muestra una alerta si la validación falla
        numeroSerieInput.value = ""; // Limpia el campo para que el usuario ingrese un nuevo valor
      }
    });
  }
  // Llama a la función de validación para el número de serie
  validarNumeroSerie();
});
