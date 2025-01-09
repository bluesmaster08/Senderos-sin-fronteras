document.addEventListener("DOMContentLoaded", function () {
  // Se asegura de que el DOM esté completamente cargado antes de ejecutar el código
  // Selección de elementos del formulario por su ID
  const capacidadPasajerosInput = document.getElementById(
    "capacidad_pasajeros"
  );
  const añoFabricacionInput = document.getElementById("año_fabricacion");
  const placaInput = document.getElementById("placa");

  // Función para validar que el valor esté en el rango especificado
  function validarRango(campo, min, max) {
    campo.addEventListener("blur", function () {
      const valor = parseInt(campo.value, 10);
      if (isNaN(valor) || valor < min || valor > max) {
        alert(`Este campo debe tener un valor entre ${min} y ${max}.`);
        campo.value = "";
      }
    });
  }
  // Validar capacidad de pasajeros (1 a 80)
  validarRango(capacidadPasajerosInput, 1, 80);
  // Validar año de fabricación (2000 a 2024)
  validarRango(añoFabricacionInput, 2000, 2024);
  // Función para validar que la placa tenga exactamente 6 caracteres numéricos
  function validarPlaca(campo) {
    campo.addEventListener("blur", function () {
      const placaValue = campo.value;

      // Verificar si la placa tiene exactamente 6 caracteres numéricos
      if (/^\d{6}$/.test(placaValue)) {
        campo.setCustomValidity("");
      } else {
        alert(
          "La placa debe ser un valor numérico de exactamente 6 caracteres."
        );
        campo.value = "";
      }
    });
  }
  // Validar placa
  validarPlaca(placaInput);
});
