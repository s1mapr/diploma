<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') . ' | Swagger Docs' }}</title>
    <link rel="stylesheet" href="/vendor/swagger-ui/swagger-ui.css"/>
</head>
<body>
<div id="swagger-ui"></div>
<script src="/vendor/swagger-ui/swagger-ui-bundle.js" crossorigin></script>
<script>
    window.onload = () => {
        window.ui = SwaggerUIBundle({
            url: '{{ $url }}',
            dom_id: '#swagger-ui',
            presets: [
                SwaggerUIBundle.presets.apis,
                SwaggerUIBundle.SwaggerUIStandalonePreset
            ],
            operationsSorter: function (a, b) {
                var order = {
                    'get': '0',
                    'put': '1',
                    'post': '2',
                    'patch': '3',
                    'delete': '4'
                };

                return order[a._root.entries[1][1]].localeCompare(order[b._root.entries[1][1]]);
            },
            tagsSorter: 'alpha',
            deepLinking: true,
            filter: true
        });
    };
</script>
</body>
</html>
