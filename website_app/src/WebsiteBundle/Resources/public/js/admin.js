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



document.querySelector('#button-edit-product').addEventListener('click', function (e) {
    const hiddenForm = document.querySelector('.hidden-form');
    if (hiddenForm.style.display === 'block') {
        hiddenForm.style.display = 'none';
    } else {
        hiddenForm.style.display = 'block';
    }
});

document.getElementById('save_changes').addEventListener('click', function (e) {
    if(!(confirm('Are you sure you want to save changes?'))) {
        e.preventDefault();
    }
});

document.getElementById('delete_button').addEventListener('click', function (e) {
   if(!(confirm('Are you sure you want to delete this item?\nThis action will be permanent!'))) {
       e.preventDefault()
   }
});






