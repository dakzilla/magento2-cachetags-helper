define([], function () {
        'use strict';
        return function (config) {
            let tags = config.tags;
            let msg = 'NO PAGE TAGS TO DISPLAY';

            if(tags.length) {
                msg = 'PAGE TAGS: ' + tags
            }

            console.log('%c ' + msg + ' ', 'background:#d22630; color:#fff; font-size:1.5em; font-weight:bold');
        };
    }
);