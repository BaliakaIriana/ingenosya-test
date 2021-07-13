/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.scss in this case)
import './styles/app.scss';
import 'bootstrap';

// start the Stimulus application
import './bootstrap';

const $ = require('jquery');
// this "modifies" the jquery module: adding behavior to it
// the bootstrap module doesn't export/return anything
require('bootstrap');

// or you can include specific pieces
// require('bootstrap/js/dist/tooltip');
// require('bootstrap/js/dist/popover');

function getVillesOfPostal($postal, $villes) {
    $.get('/code/postal/' + $postal.val() + '/villes').then((res) => {
        $villes.empty();
        let $option;
        for (const resKey in res) {
            const item = res[resKey];
            $option = $('<option>');
            $option.attr('value', item.id);
            $option.html(item.nom);
            $villes.append($option);
        }
    });
}

$(document).ready(function() {
    // $('[data-toggle="popover"]').popover();
    const $selector = $('#selector');
    const $postal = $('#societe_postal');
    const $villes = $('#societe_ville');
    getVillesOfPostal($postal, $villes);
    $selector.on('change', function() {
        const val = $selector.val();
        if(val === '1') {
            $('#dirigeant').show();
            $('#societe').hide();
        }
        if(val === '2') {
            $('#dirigeant').hide();
            $('#societe').show();
        }
    });
    $postal.on('change', function (){
       getVillesOfPostal($postal, $villes);
    });

});
