<style>
body{
    background:#F0F8FF;
}
.card {
    margin-bottom: 1.5rem;
    box-shadow: 0 1px 15px 1px rgba(52,40,104,.08);
}
.card {
    position: relative;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-direction: column;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 1px solid #e5e9f2;
    border-radius: .2rem;
}
.card-header:first-child {
    border-radius: calc(.2rem - 1px) calc(.2rem - 1px) 0 0;
}
.card-header {
    border-bottom-width: 1px;
}
.card-header {
    padding: .75rem 1.25rem;
    margin-bottom: 0;
    color: inherit;
    background-color: #fff;
    border-bottom: 1px solid #e5e9f2;
}

.form-group {
    margin-bottom: 5px;
}
</style>

<template>
    <div class="row">
        <div class="col-md-7 col-xl-8">
            <div class="tab-content">
                <div class="tab-pane fade show active" id="account" role="tabpanel">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-actions float-right">
                                <div class="dropdown show">
                                    <a href="#" data-toggle="dropdown" data-display="static">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal align-middle">
                                            <circle cx="12" cy="12" r="1"></circle>
                                            <circle cx="19" cy="12" r="1"></circle>
                                            <circle cx="5" cy="12" r="1"></circle>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                            <h5 class="card-title mb-0">Public info</h5>
                        </div>

                        <div class="card-body">
                            <form>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div v-for="settings in user.settings" class="form-check">
                                            <label :for="settings.key">{{ settings.key }}</label>
                                            <input @click="toggleSettings(settings.key)" type="checkbox" class="form-check-input" :id="settings.key" :value="settings.value" :checked="settings.value">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="text-center">
                                            <img alt="Andrew Jones" src="https://bootdey.com/img/Content/avatar/avatar1.png" class="rounded-circle img-responsive mt-2" width="128" height="128">
                                            <div class="mt-2">
                                                <span class="btn btn-primary"><i class="fa fa-upload"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import {onMounted, ref} from "vue";

const props = defineProps({
    user_id: Number
});

// Данные пользователя
const user = ref({
    name: '',
    email: '',
    settings: []
});

onMounted(() => {
    axios.get(`/api/v1/users/${props.user_id}`).then(response => {
        user.value.name = response.data.payload.user.name;
        user.value.email = response.data.payload.user.email;
        user.value.settings = response.data.payload.settings;
    });
});

/**
 * Функция возвращает каким путём подтвердить
 *
 * @returns {string}
 */
const makeChoiceSubmit = () => {
    return 'telegram';
}

/**
 * Изменить настройку
 */
const toggleSettings = (settingsKey) => {
    // TODO: Вызов модального окна для выбора через какой сервис подтвердить операцию: telegram, sms, email
    const TYPE_SUBMIT = makeChoiceSubmit();

    // TODO: Отправка кода выбранным путём
    axios.post(`/api/v1/users/${props.user_id}/toggle`, {
        key: settingsKey,
        type: TYPE_SUBMIT
    });
};

/**
 * Открыть модальное окно для подтверждения
 */
const toggleModalSubmit = () => {
    // TODO: Some logic here...
}

/**
 * Подтвердить изменение настройки
 */
const submit = (code) => {
    axios.post(`/api/v1/users/${props.user_id}/verify`);
}
</script>
