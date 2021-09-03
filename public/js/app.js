$( document ).ready(function() {
    $(document).on('click', '.btn-secondary', function(){
        $.ajax({
            url: "/api/get-feed",
            dataType: 'json',
            success: function (result) {
                console.log(result.data);
                $('#result').html('');
                if (result.data !== null) {
                    let response = '';
                    for (key in result.data) {
                        if (key == 'updated_at' || key == 'created_at') {
                            continue;
                        }
                        response += '<p><span>' +  key +':</span> ';

                        if (key == 'image') {
                            response += '<span><img width="150" src="' + result.data[key] + '"></span>';
                        } else {
                           response += '<span>' + result.data[key] + '</span>';
                        }

                        response += '</p>';
                    }
                    $('#result').html(response);
                }
            }
        });
    });
});
