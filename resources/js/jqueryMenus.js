import $ from 'jquery';
import 'formstone/src/js/navigation';

let $menu = $('#navigation');

$menu.navigation({
    type: 'overlay',
    gravity: 'left',
    maxWidth: '991px',
    label: false
});
