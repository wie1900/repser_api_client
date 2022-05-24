
clearFields = function (){
    document.querySelectorAll('.field').forEach(field =>{
        field.value = ""; // for textareas
        field.innerHTML = ""; // for divs
    });
}
