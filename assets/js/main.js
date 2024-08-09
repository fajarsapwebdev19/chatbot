$(document).ready(function() {

    $('.to-chatbot').click(function(){
        window.location.href='?page=kontak';
    })

    // Tampilkan pesan petunjuk awal jika chat box kosong
    function showWelcomeMessage() {
        if ($('#chat-box').children().length === 0) {
            $('#welcome-message').show();
        }
    }

    showWelcomeMessage();

    $('#chat-form').on('submit', function(e) {
        e.preventDefault();
        let userInput = $('#user-input').val().trim();
        let chat = $('.chat_control').val();

        userInput = $('<div/>').text(userInput).html();

        if (userInput) {
            // Sembunyikan pesan sambutan setelah ada pesan dari pengguna
            $('#welcome-message').hide();
            
            $('#chat-box').append('<div class="message user"><span>' + userInput + '</span></div>');

            if(chat == "1")
            {
                $.ajax({
                    url: 'response/toko1.php',
                    data: {message: userInput},
                    method: 'POST',
                    success:function(response)
                    {
                        response = $('<div/>').html(response).html();
                        $('#chat-box').append('<div class="message bot"><span>' + response + '</span></div>');
                        $('#user-input').val('');
                        $('#chat-box').scrollTop($('#chat-box')[0].scrollHeight);
                    }
                });
            }
            else if(chat == "2")
            {
                $.ajax({
                    url: 'response/toko2.php',
                    data: {message: userInput},
                    method: 'POST',
                    success:function(response)
                    {
                        response = $('<div/>').html(response).html();
                        $('#chat-box').append('<div class="message bot"><span>' + response + '</span></div>');
                        $('#user-input').val('');
                        $('#chat-box').scrollTop($('#chat-box')[0].scrollHeight);
                    }
                });
            }
            else if(chat == "3")
            {
                $.ajax({
                    url: 'response/toko3.php',
                    data: {message: userInput},
                    method: 'POST',
                    success:function(response)
                    {
                        response = $('<div/>').html(response).html();
                        $('#chat-box').append('<div class="message bot"><span>' + response + '</span></div>');
                        $('#user-input').val('');
                        $('#chat-box').scrollTop($('#chat-box')[0].scrollHeight);
                    }
                });
            }
        } else {
            alert('Silakan ketikkan pertanyaan.');
        }
    });
});