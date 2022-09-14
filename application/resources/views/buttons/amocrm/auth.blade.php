<div class="div-amo-connect">
    <script
        class="amocrm_oauth"
        charset="utf-8"
        data-name="{{ config('services.amocrm.app_name') }}"
        data-description="{{ config('services.amocrm.description') }}"
        data-redirect_uri="{{ config('services.amocrm.redirect_uri') }}"
        data-secrets_uri="{{ config('services.amocrm.secrets_uri') }}"
        data-logo=""
        data-scopes="crm"
        data-title="Подключить платформу"
        data-compact="false"
        data-class-name="amo-connect"
        data-color="white"
        data-state="hello"
        data-error-callback="functionName"
        data-mode="popup"
        src="https://www.amocrm.ru/auth/button.min.js">
    </script>
</div>
