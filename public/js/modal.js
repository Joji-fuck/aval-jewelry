document.addEventListener('DOMContentLoaded', function () {
    var createModalElement = document.getElementById('createModal');

    var modalForm = createModalElement.querySelector('#createForm');
    var modalTitle = createModalElement.querySelector('.modal-title');
    var nameInput = createModalElement.querySelector('#nameInput');

    createModalElement.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;

        // Получаем данные из атрибутов кнопки
        var titleText = button.getAttribute('data-title');
        var actionUrl = button.getAttribute('data-action');
        var currentValue = button.getAttribute('data-value');
        var method = button.getAttribute('data-method');

        modalTitle.textContent = titleText;
        modalForm.action = actionUrl;

        if (currentValue) {
            nameInput.value = currentValue;
        } else {
            nameInput.value = '';
        }

        var existingMethodInput = modalForm.querySelector('input[name="_method"]');
        if (existingMethodInput) {
            existingMethodInput.remove();
        }

        if (method === 'PUT') {
            var methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'PUT';
            modalForm.appendChild(methodInput);
        }
    });
});
