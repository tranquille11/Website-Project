const buttons = document.querySelectorAll('.menu-button');

buttons.forEach(function (elem) {
    elem.addEventListener('click', function (e) {
        const hiddenDiv = this.nextElementSibling;
        if (hiddenDiv.style.display === 'block') {
            hiddenDiv.style.display = 'none';
        } else {
            hiddenDiv.style.display = 'block';
        }
    })
});






