<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <style>
            *{
                margin: 0;
                padding: 0;
            }
            ::-webkit-scrollbar{
                width: 5px;
            }
            ::-webkit-scrollbar-track{
                background: #13254c;

            }
            ::-webkit-scrollbar-thumb{
                background: #061128;
            }
    </style>
    <body style="background: #05113b;">
        <div>
            <div class="container-fluid m-0 d-flex p-2">
                <div class="pl-2" style="width: 40px;height: 50px; font-size: 30;">
                    <i class="fa fa-angle-double-left text-white mt-2"></i>
                </div>
                <div style="width: 50px;height: 50px;">
                    <img src="https://cdn-icons-png.flaticon.com/512/3541/3541871.png" width="100%" height="100%" style="border-radius: 50px;">
                </div>
                <div class="text-white font-weight-bold ml-2 mt-2">
                    Chatbot
                </div>
            </div>
            <div style="background: #061128;height: 2px;"></div>
                <div id="content-box" class="container-fluid p-2" style="height: calc(100bh - 130px);overflow-y: scroll;">
                    
                </div>
                
                <div class="container-fluid w-100 px-3 py-2 d-flex" style="background: #131f45; min-height: 62px;max-height: auto;position: fixed;bottom: 0;">
                <div class="mr-2 pl-2" style="background: #ffffff1c;width: calc(100% - 45px);min-height: 62px;max-height: auto;border-radius: 5px;">
                    <textarea 
                    id="input" 
                    class="my-textarea text-white form-control" 
                    rows="1" 
                    style="background: none; width: 100%; overflow-y: auto; resize: vertical; border: none; outline: none; word-wrap: break-word;min-height: 62px;max-height: auto;" 
                    placeholder="Type your message here..." 
                    ></textarea>
                </div>
                <div id="button-submit" class="text-center" style="background: #4acfee;height: 100%;width: 50px;border-radius: 10px;">
                    <i class="fa fa-paper-plane text-white" style="line-height: 45px;"></i>
                </div>
                </div>
            </div>
        </div>
        
    </body>
</html>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function() {
    console.log("DOM is ready");

    $('#button-submit').on('click', function() {
        // Get the value from the input field
        $value = $('#input').val();

        // Append the input value to the content box
        $('#content-box').append(`
            <div class="mb-2">
                <div class="float-right px-3 py-2" style="width: 270px;min-height: 35px;max-height: auto;display: flex;flex-direction: column;background: #4acfee;border-radius: 20px;float: right;font-size: 85%;">
                    ${$value}
                </div>
                <div style="clear: both;"></div>
            </div>
        `);

        // Make the AJAX request
        $.ajax({
            type: 'post',
            url: '{{url('send')}}',
            data: {
                'input': $value
            },
            success: function(data) {
                // On success, append the response data with an image
                $('#content-box').append(`
                    <div class="d-flex mb-2">
                        <div style="width: 20px;height: 20px;">
                            <img src="https://cdn-icons-png.flaticon.com/512/3541/3541871.png" width="100%" height="100%" style="border-radius: 20px;">
                        </div>
                        <div class="float-right px-3 py-2" style="width: 270px;min-height: 35px;max-height: auto;background: #4acfee;border-radius: 20px;float: right;font-size: 85%;display: flex;flex-direction: column">
                            ${data}
                        </div>
                    </div>
                `);
            },
            error: function(error) {
                console.log("Error in sending data:", error);
            }
        });

        // Clear the input field
        $('#input').val('');
    });
});
</script>
<script>
const textarea = document.querySelector('.my-textarea');

textarea.addEventListener('input', function () {
  this.style.height = 'auto';  // Reset height to auto to shrink if content is deleted
  this.style.height = (this.scrollHeight) + 'px';  // Set height to scrollHeight to fit the content
});
</script>
