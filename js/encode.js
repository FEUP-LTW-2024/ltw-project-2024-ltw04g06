const entityMap = {
    "&": "&amp;",
    "<": "&lt;",
    ">": "&gt;",
    '"': '&quot;',
    "'": '&#39;',
    "/": '&#x2F;'
};

function escapeHtml(string) {
    return String(string).replace(/[&<>"'\/]/g, function (s) {
        return entityMap[s];
    });
}

function encodeAndSendMessage(event, formId, endpoint) {
    event.preventDefault();

    const form = document.getElementById(formId);
    const formData = new FormData(form);

    for (let [key, value] of formData.entries()) {
        if (typeof value === 'string') {
            formData.set(key, escapeHtml(value));
        }
    }

    fetch(endpoint, {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (response.status === 302) {
            const locationHeader = response.headers.get('Location');
            window.location.href = locationHeader;
        } else {
            return response.text();
        }
    })
    .then(data => {
        const encodedMessageElement = document.getElementById('encodedMessage');
        if (encodedMessageElement) {
            encodedMessageElement.innerHTML = data;
        }
    })
    .catch(error => console.error('Error:', error));
}
