<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport" >

        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="assets/css/main.css">
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
        <title>check http status</title>
    </head>
    
    <body>  
        <form>
            <div class="container">
                <h1>Write address(each on line) and you get number of server response.</h1>
                <div id="response"></div>
                <div class="form-group">
                    <label for="address">Area for addresses www(response in format address -> number of response redirect if is any):</label>
                    <textarea class="form-control" rows="10" id="address"></textarea>
                </div>
                <button id="send" type="submit" class="btn btn-default">Submit</button>
            </div>
        </form>
        
        <script>
            $(document).ready(() => {
                $('#send').on('click',  (e) => {
                    e.preventDefault();
                    
                    let lines = $('#address').val().split(/\n/),
                        urls = [];
                    
                    for (var i = 0; i < lines.length; i++) {
                        if (/\S/.test(lines[i])) {
                            urls.push($.trim(lines[i]));
                        }
                    }
                    
                    $.ajax({
                        type: 'POST',
                        url: 'checkStatus.php',
                        data: {
                            urls: urls,
                        },
                        success: (ret) => {
                            $('#response').html(ret);
                        },
                        error: (jqXHR, errorText, errorThrown) => {
                            alert('error, try again.');
                            console.log(jqXHR, errorText, errorThrown);
                        }
                    });
                });
            });
        </script>
    </body>
</html>
