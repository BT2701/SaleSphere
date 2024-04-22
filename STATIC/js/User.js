document.addEventListener('DOMContentLoaded', function () {
    var myAlert = document.getElementById('myAlert');
    var closeButton = myAlert.querySelector('.btn-close');

    closeButton.addEventListener('click', function () {
        myAlert.classList.add('fade');
        setTimeout(function () {
            myAlert.style.display = 'none';
        }, 500); // thời gian fade out (500ms)
    });
});
