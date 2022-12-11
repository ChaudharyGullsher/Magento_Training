require([
    'jquery'
], function ($) {
    'use strict';

    $(".level-2").click(function () {
        $(".item-extension_menu.parent.level-1").addClass("active");
    });

    $(".admin__menu .action-close").click(function () {
        $(".item-extension_menu.parent.level-1").removeClass("active");
    });
});
