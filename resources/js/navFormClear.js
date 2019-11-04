import $ from 'jquery';

$(document).ready(function () {
    const button = document.querySelector('#nav_clear');
    const form = document.querySelector("#nav_form");

    button.addEventListener('click', () => {
        form.reset();
    });
})