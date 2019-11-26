import $ from 'jquery';

$(document).ready(function () {
    var propEnvironmentCount = $('.prop-environment-form > div').length;

    if (!$('.prop-environment-form')) {
        return;
    }

    if ($('.prop-environment-form').children().length <= 1) {
        $('.prop-environment-form').find('.prop-environment-form__remove').css('display', 'none')
    } else {
        $(".prop-environment-form div:first-child").find(".prop-environment-form__remove").css('display', 'inline-block')
    }


    $(".prop-environment-form__add").on("click", function (e) {
        e.preventDefault();

        propEnvironmentCount = propEnvironmentCount + 1;
        var mainsection = $(".prop-environment-form");
        var submainsec = $("<div>", {
            'id': "prop-environmnet-form__entry-" + propEnvironmentCount,
        });
        mainsection.append(submainsec);
        submainsec.append($("<p>", {
            'text': "Environment " + propEnvironmentCount,
        })).append($("<label>", {
            'text': "Type:",
        })).append($("<input>", {
            'type': "text",
            'name': `env_types[${propEnvironmentCount}]`,
        })).append($("<label>", {
            'text': "Server:"
        })).append($("<input>", {
            'type': "text",
            'name': `env_servers[${propEnvironmentCount}]`,
        })).append($("<label>", {
            'text': "URL:"
        })).append($("<input>", {
            'type': "text",
            'name': `env_urls[${propEnvironmentCount}]`,
        }));
    })

    $(".prop-environment-form__remove").on("click", "", function (e) {
        e.preventDefault();

        if (propEnvironmentCount == 1) { 
            return;
        }
        $(`#prop-environmnet-form__entry-${propEnvironmentCount}`).remove();
        propEnvironmentCount = propEnvironmentCount - 1;
    })
}) 