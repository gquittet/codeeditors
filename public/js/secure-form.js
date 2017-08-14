var form = document.getElementById("form");
var canSubmit = false;
form.onsubmit = function(ev) {
    ev.preventDefault();
    for (var i = 0; i < form.elements.length; i++) {
        canSubmit = true;
        if (form.elements[i] == '' || form.elements[i] == null) {
            alert("Empty field");
            canSubmit = false;
            break;
        }
    }
    if (canSubmit) {
        form.submit();
    }
}