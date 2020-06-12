var url = 'http://proyecto-redsocial.com.devel'
window.addEventListener('load', function () {

    $('.btn-like').css('cursor', 'pointer');
    $('.btn-dislike').css('cursor', 'pointer');

    //Boton like
    function like() {
        $('.btn-like').unbind('click').click(function () {
            $(this).addClass('btn-dislike').removeClass('btn-like');
            $(this).attr('src', url+'/images/like1.png');

            $.ajax({
                url:url+'/like/'+$(this).data('id'),
                type: 'GET',
                success: function(response){
                    console.log(response)
                }
            })

            dislike();
        });
    }
    like();

    //boton dislike
    function dislike() {
        $('.btn-dislike').unbind('click').click(function () {
            $(this).addClass('btn-like').removeClass('btn-dislike');
            $(this).attr('src', url+'/images/like2.png');
            
            $.ajax({
                url:url+'/dislike/'+$(this).data('id'),
                type: 'GET',
                success: function(response){
                    console.log(response)
                }
            })

            like();
        });
    }
    dislike();

})