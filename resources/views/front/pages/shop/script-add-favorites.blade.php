<script>
    $( ".btn-add-favorites" ).on( "click", function() {
        var url = '{{ route('user.favorites.add', ':id') }}';
        url = url.replace(':id', $( this ).attr('data-id') );
        console.log(2);
        $.easyAjax({
            url,
            type: 'POST',
            redirect: false,
            data: {'_token':'{{csrf_token()}}', id:$( this ).attr('data-id')  },
            success: (response)=> {
                if(response.action ){
                    switch (response.action) {
                        case 'remove':
                            $(this).removeClass('color-bck-hover-auto');
                            break;
                        case 'add':
                            $(this).addClass('color-bck-hover-auto');
                            break;
                        default:
                            break;
                    }
                }
            },
            error: function(error) {
                notifyErrorGlobal(error);
            }
        });
    });
</script>