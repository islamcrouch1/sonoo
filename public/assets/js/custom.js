$(document).ready(function(){

    $('.btn').on('click' , function(e){

        e.preventDefault

        var check = 0;

        $(this).closest('form').find('input').each(function() {
            if ($(this).prop('required') && $(this).val() == '' ) {
                check++;
            }
        });

          if(check == 0){
            $(this).closest('form').submit(function () {
                $('.btn').attr("disabled", true);
            });
        }


    });



    $(".img").change(function() {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('.img-prev').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]); // convert to base64 string
        }
    });



    $("#show-pass").on('click', function(event) {
        event.preventDefault();
        if($('#show_hide_password input').attr("type") == "text"){
            $('#show_hide_password input').attr('type', 'password');
            $('#show_hide_password svg').addClass( "fa-eye-slash" );
            $('#show_hide_password svg').removeClass( "fa-eye" );
        }else if($('#show_hide_password input').attr("type") == "password"){
            $('#show_hide_password input').attr('type', 'text');
            $('#show_hide_password svg').removeClass( "fa-eye-slash" );
            $('#show_hide_password svg').addClass( "fa-eye" );
        }
    });


    var startMinute = 1;
    var time = startMinute * 60;

    setInterval(updateCountdown , 1000);

    function updateCountdown(){

    var minutes = Math.floor(time / 60);
    var seconds = time % 60 ;

    seconds < startMinute ? '0' + seconds : seconds;

    $('.counter_down').html(minutes + ':' + seconds)


    if(minutes == 0 && seconds == 0){

        $('.resend').css('pointer-events' , 'auto');


    }else{
        time--;
    }
    }
});
