function deleteConfirm() {
    var anchors = document.getElementsByClassName("confirm_dialog");
    for (var i = 0; i < anchors.length; i++) {
        anchors[i].onclick = function () {
            $message = this.getAttribute('data-confirm');
            if ($message === null) {
                $message = "Weet je het zeker?";
            }
            return confirm($message);
        };
    }
}

function autofill_name(name) {

    var inputField = document.getElementById("name_respondent");
    var dropdown = document.getElementById("respondent");

    if (dropdown.options[dropdown.selectedIndex].value !== "Ikzelf") {
        inputField.value = '';
        inputField.readOnly = false;
    } else {
        inputField.value = name;
        inputField.readOnly = true;
    }

}
