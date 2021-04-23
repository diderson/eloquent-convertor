<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="Laravel,Eloquent,Builder">
    <title>SQL to Laravel Builder</title>
    <link href="/css/fontawesome.min.css" rel="stylesheet">
    <link href="/css/bulma.min.css" rel="stylesheet">
    <link href="/css/style.css?v={{date('Ymdhis')}}" rel="stylesheet">
</head>

<body>

    <section class="hero is-primary is-small">

        <div class="hero-body">
            <div class="container has-text-centered">
                <h1 class="title">
                    Convert Your Laravel Query Builder to Legacy SQL</h1>
            </div>
        </div>

    </section>

    <div>
        <div class="columns is-mobile is-centered">
            <div class="column is-two-thirds">
                <div class="content-area">
                    <div class="box box-offset">

                        <div class="field">
                            <div class="control">
                                <textarea class="textarea" name="sql" rows="10" placeholder="Enter Your Eloquent" id="input"></textarea>
                            </div>
                        </div>
                        <div class="field">
                            <div class="field-body">
                                <div class="field">
                                    <div class="control has-text-centered">
                                        <button class="button is-primary" onclick="convert()">
                    Convert
                  </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="box box-offset">
                        <div class="field">
                            <div class="control">
                                <textarea class="textarea" name="sql" rows="10" placeholder="Output" id="output"></textarea>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</body>
<script src="js/sql-parser.js"></script>
<script src="js/builder.js"></script>
<script>
    function convert() {
        let input = document.getElementById("input").value;

        if (input.trim() == '') {
            return;
        }

        if (input.slice(-1) == ';') {
            input = input.slice(0, -1);
        }

        let parsed = null;

        fetch('/convert-eloquent-to-sql', {
                    method: 'get',
                    body: JSON.stringify({
                        "title": "Convert failed",
                        "body": input,
                        "assignees": [
                            "sql2builder"
                        ],
                        "labels": [
                            "bug"
                        ]
                    }),
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'Authorization': 'token 7786eb107fe6bf689802882ca51c42ff820856c6',
                    }
                }).then(function(response) {
                    return response.json();
                }).then(function(data) {
                    console.log('Created Issue success.', data);
                });
    }
</script>

</html>