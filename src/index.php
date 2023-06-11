<!DOCTYPE html>
<html>
<head>
    <title>EVE Online Characters</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-dark text-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 text-center mt-5 mb-4">
                <h1 class="display-4">EvE Corps Checker</h1>
            </div>
        </div>
        <form id="eve-form" class="row">
            <div class="col-6">
                <textarea id="names" name="names" class="form-control my-2" placeholder="Enter character names separated by a newline" rows="20"></textarea>
            </div>
            <div class="col-6">
                <textarea id="output" name="output" class="form-control my-2" rows="20" readonly></textarea>
            </div>
            <div class="col-12">
            <button id="submit-button" type="submit" class="btn btn-success btn-lg btn-block my-2">
                <span id="spinner" class="spinner-border spinner-border-md" role="status" aria-hidden="true" style="display: none;"></span>
                Submit
            </button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('eve-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const names = document.getElementById('names').value;
            const output = document.getElementById('output').value;
            const submitButton = document.getElementById('submit-button');
            document.getElementById("names").value = "";

            submitButton.disabled = true;
            document.getElementById('spinner').style.display = 'inline-block';


            fetch('request.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    names: names,
                    output: output
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('output').value = data.data.newMatches.join('\n') + "\n--\n" + data.data.previousMatches;
                } else {
                    alert('An error occurred: ' + data.data);
                }
            })
            .catch((error) => {
                console.error('Error:', error);
            })
            .finally(() => {
                submitButton.disabled = false;
                document.getElementById('spinner').style.display = 'none';
            });
        });
    </script>
</body>
</html>