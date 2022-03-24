{{--@extends('platform::app')--}}
{{--<head>--}}
{{--  <meta charset="UTF-8"/>--}}
{{--  <title>Интеграция с Bizon 365</title>--}}
{{--</head>--}}
{{--    <body>--}}

{{--<div class="div-amo-connect">--}}
{{--    <script--}}
{{--        class="amocrm_oauth"--}}
{{--        charset="utf-8"--}}
{{--        data-client-id="0a74a4bc-fe16-4ce9-8fa6-1456356e93b7"--}}
{{--        data-name="Интеграция с Bizon 365"--}}
{{--        data-description="Интеграция с Bizon 365"--}}
{{--        data-redirect_uri="https://hub.blackclever.ru/platform/public/amocrm/redirect_uri"--}}
{{--        data-secrets_uri="https://hub.blackclever.ru/platform/public/api/amocrm/secrets_uri"--}}
{{--        data-logo=""--}}
{{--        data-scopes="crm"--}}
{{--        data-title="Подключить"--}}
{{--        data-compact="false"--}}
{{--        data-class-name="amo-connect"--}}
{{--        data-color="white"--}}
{{--        data-state="hello"--}}
{{--        data-error-callback="functionName"--}}
{{--        data-mode="popup"--}}
{{--        src="https://www.amocrm.ru/auth/button.min.js">--}}
{{--    </script>--}}
{{--</div>--}}

<div class="div-amo-connect">
    <script
        class="amocrm_oauth"
        charset="utf-8"
        data-client-id="8351a88a-3286-472d-b687-99c81651b65c"
        data-name="clever-platform-dev"
        data-description="clever-platform-dev"
        data-redirect_uri="https://hub.blackclever.ru/clever-platform/public/amocrm/redirect_uri"
        data-secrets_uri="https://webhook.site/9f9367bd-df59-402c-9bd2-39412685f8e0"
        data-logo=""
        data-scopes="crm"
        data-title="Подключить интеграцию"
        data-compact="false"
        data-class-name="amo-connect"
        data-color="white"
        data-state="hello"
        data-error-callback="functionName"
        data-mode="popup"
        src="https://www.amocrm.ru/auth/button.min.js">
    </script>
</div>
{{--?user="{{ \Illuminate\Support\Facades\Auth::user()->uuid }}--}}
{{--    </body>--}}
