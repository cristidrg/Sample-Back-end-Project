import $ from 'jquery';
import 'formstone/src/js/tabs';

console.log($(".tab"))
window.addEventListener('DOMContentLoaded', (event) => {
    $(".prop-page__tab").tabs({
        mobileMaxWidth: '1px'
    });
});
