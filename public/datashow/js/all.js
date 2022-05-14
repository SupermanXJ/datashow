const DS = {
    api: (param) => {
        const p = $.extend(true, {
            method: 'GET',
            dataType: 'json'
        }, param);

        return $.ajax(p);
    }
};