// Agrega un evento que se ejecuta cuando el DOM está completamente cargado
document.addEventListener("DOMContentLoaded", function () {
  // Selección de elementos del formulario por su ID
  const nombreInput = document.getElementById("nombre");
  const apellidoInput = document.getElementById("apellido");
  const segundoApellidoInput = document.getElementById("segundo_apellido");
  const fechaNacimientoInput = document.getElementById("fecha_nacimiento");
  const sexoInputs = document.querySelectorAll('input[name="sexo"]');
  const entidadFederativaSelect = document.getElementById("entidad_federativa");
  const curpInput = document.getElementById("curp");
  const rfcInput = document.getElementById("rfc");

  //**FUNCIONES AUXILIARES CURP**/
  // Función para obtener la primera vocal interna de una cadena
  function obtenerVocalInterna(str) {
    // Usa una expresión regular para buscar vocales (i: insensible a mayúsculas)
    const vocales = str.slice(1).match(/[AEIOU]/i);
    return vocales ? vocales[0] : "X"; // Si no encuentra vocal, devuelve "X"
  }

  // Función para obtener la primera consonante interna de una cadena
  function obtenerPrimeraConsonanteInterna(str) {
    // Usa una expresión regular para buscar consonantes (i: insensible a mayúsculas)
    const consonantes = str.slice(1).match(/[BCDFGHJKLMNÑPQRSTVWXYZ]/i);
    return consonantes ? consonantes[0] : "X"; // Si no encuentra consonante, devuelve "X"
  }

  // Función para obtener la clave de la entidad federativa dada su abreviatura
  function obtenerEntidadFederativaClave(entidad) {
    // Diccionario de claves de entidades federativas
    const claves = {
      AS: "AS",
      BC: "BC",
      BS: "BS",
      CC: "CC",
      CL: "CL",
      CM: "CM",
      CS: "CS",
      CH: "CH",
      DF: "DF",
      DG: "DG",
      GT: "GT",
      GR: "GR",
      HG: "HG",
      JC: "JC",
      MC: "MC",
      MN: "MN",
      MS: "MS",
      NT: "NT",
      NL: "NL",
      OC: "OC",
      PL: "PL",
      QT: "QT",
      QR: "QR",
      SP: "SP",
      SL: "SL",
      SR: "SR",
      TC: "TC",
      TS: "TS",
      TL: "TL",
      VZ: "VZ",
      YN: "YN",
      ZS: "ZS",
    };
    return claves[entidad] || "NE"; // Devuelve la clave correspondiente o "NE" si no se encuentra
  }

  //**FUNCION PRINCIPAL CURP**/
  // Función para generar la CURP usando los datos ingresados por el usuario
  function generarCURP() {
    // Obtiene y convierte los valores a mayúsculas
    const nombre = nombreInput.value.toUpperCase();
    const apellido = apellidoInput.value.toUpperCase();
    const segundoApellido = segundoApellidoInput.value.toUpperCase();
    const fechaNacimiento = fechaNacimientoInput.value;
    const sexo = Array.from(sexoInputs)
      .find((input) => input.checked)
      ?.value.toUpperCase();
    const entidadFederativa = entidadFederativaSelect.value.toUpperCase();

    if (
      nombre &&
      apellido &&
      segundoApellido &&
      fechaNacimiento &&
      sexo &&
      entidadFederativa
    ) {
      const [año, mes, día] = fechaNacimiento.split("-");
      const curp =
        apellido[0] +
        obtenerVocalInterna(apellido) +
        segundoApellido[0] +
        nombre[0] +
        año.slice(2) +
        mes +
        día +
        sexo[0] +
        obtenerEntidadFederativaClave(entidadFederativa) +
        obtenerPrimeraConsonanteInterna(apellido) +
        obtenerPrimeraConsonanteInterna(segundoApellido) +
        obtenerPrimeraConsonanteInterna(nombre);
      curpInput.value = curp; // Asigna la CURP generada al campo correspondiente
    }
  }

  // Función para validar que el campo contenga solo palabras
  function validarPalabra(campo) {
    const regex = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/; // Expresión regular para validar palabras
    if (!regex.test(campo.value)) {
      alert("Solo se permiten palabras en este campo."); // Muestra alerta si no coincide
      campo.value = ""; // Limpia el campo si la validación falla
    }
  }
  //**FUNCIONES PARA VALIDACIONES DE CAMPOS DEL FORMULARIO DE REGISTRO* */
  // Función para validar la longitud exacta de un campo cuando pierde el enfoque
  function validarLongitud(campo, longitud) {
    campo.addEventListener("blur", function () {
      if (campo.value.length !== longitud) {
        alert(
          `Este campo debe tener una longitud exacta de ${longitud} caracteres.`
        );
        campo.value = ""; // Limpia el campo si la validación falla
      }
    });
  }

  // Asignación de eventos para validar los campos de entrada
  nombreInput.addEventListener("input", () => validarPalabra(nombreInput));
  apellidoInput.addEventListener("input", () => validarPalabra(apellidoInput));
  segundoApellidoInput.addEventListener("input", () =>
    validarPalabra(segundoApellidoInput)
  );

  // Asignación de eventos para validar la longitud de RFC y CURP
  validarLongitud(curpInput, 18);
  validarLongitud(rfcInput, 13);

  // Asignación de eventos para generar la CURP en tiempo real cuando los valores de las entradas cambian
  nombreInput.addEventListener("input", generarCURP);
  apellidoInput.addEventListener("input", generarCURP);
  segundoApellidoInput.addEventListener("input", generarCURP);
  fechaNacimientoInput.addEventListener("input", generarCURP);
  sexoInputs.forEach((input) => input.addEventListener("change", generarCURP));
  entidadFederativaSelect.addEventListener("change", generarCURP);
});
