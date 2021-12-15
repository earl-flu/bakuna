/*
 *  jquery-ph-locations - v1.0.0
 *  jQuery Plugin for displaying dropdown list of Philippines' Region, Province, City and Barangay in your webpage.
 *  https://github.com/buonzz/jquery-ph-locations
 *
 *  Made by Buonzz Systems
 *  Under MIT License
 */
(function ($, window, document, undefined) {
    "use strict";

    // defaults
    var pluginName = "ph_locations",
        defaults = {
            location_type: "city", // what data this control supposed to display? regions, provinces, cities or barangays?,
            api_base_url: "https://ph-locations-api.buonzz.com/",
            // api_base_url: 'http://127.0.0.1:8000/',
            filter: {},
        };

    // plugin constructor
    function Plugin(element, options) {
        // console.log(options, 'OPTION')
        this.element = element;
        this.settings = $.extend({}, defaults, options);
        this._defaults = defaults;
        this._name = pluginName;
        this.init();
    }

    // Avoid Plugin.prototype conflicts
    $.extend(Plugin.prototype, {
        init: function () {
            return this;
        },

        fetch_list: function (filter) {
            // console.log(filter, "filter");
            // console.log(this.settings.location_type)
            this.settings.filter = filter;

            $.ajax({
                type: "GET",
                url:
                    this.settings.api_base_url +
                    "v1/" +
                    this.settings.location_type,
                // url: this.settings.api_base_url + 'api/' +  this.settings.location_type,
                success: this.onDataArrived.bind(this),
                data: $.param(this.map_parameters()),
            });
        }, // fetch list
        onDataArrived(data) {
            // console.log(data, "data");
            $(this.element).html(this.build_options(data));
        },

        map_parameters() {
            var mapped_parameter = {
                filter: {
                    where: {},
                },
            };

            for (var property in this.settings.filter)
                mapped_parameter.filter.where[property] = this.settings.filter[
                    property
                ];
            // console.log(mapped_parameter, "mapped test");
            // console.log($.param(mapped_parameter), "mapped parameter");

            return mapped_parameter;
        },

        build_options(params) {
            // console.log(params)
            var shtml = "";
            shtml +=
                '<option value="" selected disabled>Please Select Here</option>';
            for (var i = 0; i < params.data.length; i++) {
                shtml +=
                    '<option value="' +
                    params.data[i].name +
                    " __" +
                    params.data[i].id +
                    '" id="' +
                    params.data[i].id +
                    '">';
                shtml += params.data[i].name;
                shtml += "</option>";
            }

            // remove city of manila if exist
            if (
                shtml.indexOf(
                    '<option value="CITY OF MANILA __1339" id="1339">CITY OF MANILA</option>'
                ) >= 0
            ) {
                shtml = shtml.replace(
                    '<option value="CITY OF MANILA __1339" id="1339">CITY OF MANILA</option>',
                    ""
                );
            }

            return shtml;
        },
    });

    $.fn[pluginName] = function (options, args) {
        return this.each(function () {
            var $plugin = $.data(this, "plugin_" + pluginName);
            if (!$plugin) {
                var pluginOptions = typeof options === "object" ? options : {};
                $plugin = $.data(
                    this,
                    "plugin_" + pluginName,
                    new Plugin(this, pluginOptions)
                );
            }

            if (typeof options === "string") {
                if (typeof $plugin[options] === "function") {
                    if (typeof args !== "object") args = [args];
                    $plugin[options].apply($plugin, args);
                }
            }
        });
    };
})(jQuery, window, document);
