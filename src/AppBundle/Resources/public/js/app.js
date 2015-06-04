$(function(){
    $(document).on('click', '.delete-row', function(e){
        e.preventDefault();

        var src = $(this).attr('href');

        console.log(src);

        $.post(
            src,
            function(data, info){
                console.log(info);

                if (info.statusCode == 200) {
                    document.reload();
                }
            }
        );
    })
});