function editComment(elementId) {
    let messageElement = document.getElementById(elementId);
    if (messageElement) {
        let form = document.createElement("form");
        form.setAttribute("method", "post");
        form.setAttribute("action", "http://127.0.0.1:8000/comment/save");

        let inputCSRF = document.createElement("input");
        inputCSRF.setAttribute("type", "hidden");
        inputCSRF.setAttribute("value", document.querySelector('meta[name="csrf-token"]').content);
        inputCSRF.setAttribute("name","_token");
        form.appendChild(inputCSRF);

        let inputId = document.createElement("input");
        inputId.setAttribute("type", "text")
        inputId.setAttribute("name", "id")
        inputId.setAttribute("hidden", true)
        inputId.setAttribute("value", elementId)
        form.appendChild(inputId)

        let textarea = document.createElement("textarea");
        textarea.setAttribute("name", "message");
        textarea.setAttribute("class", "input-message form-control");
        textarea.value = messageElement.innerText;
        form.appendChild(textarea);

        let submitButton = document.createElement("button");
        submitButton.setAttribute("type", "submit");
        submitButton.setAttribute("class", "btn btn-primary  mt-3");
        submitButton.innerText = "Update";
        form.appendChild(submitButton);
        messageElement.parentNode.replaceChild(form, messageElement);
    }
}
