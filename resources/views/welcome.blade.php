<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Landing Page</title>

        <link href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.1/css/bulma.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="{!! asset('css/style.css') !!}" rel="stylesheet" type="text/css">
    </head>
    <body>
        <section id="app" class="section">
            <div class="container">
                <h1 class="title">
                    Landing Page
                </h1>
                <p class="subtitle">
                    Landing Page for Dial Host Test
                </p>
                <p>
                    <span class="required">*</span> Campo Obrigatório
                </p>
                <div v-if="message" class="notification is-primary">
                    @{{ message}}
                </div>
                <div v-if="errors" class="notification is-danger">
                    <div v-for="error in errors">
                        @{{ error[0] }}
                    </div>
                </div>
                <form>
                    {{ csrf_field() }}
                    <div class="columns">
                        <div class="column">
                            <div class="field">
                                <label class="label">Nome<span class="required">*</span></label>
                                <div class="control">
                                    <input class="input" v-model="user.name" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="column">
                            <div class="field">
                                <label class="label">E-mail<span class="required">*</span></label>
                                <div class="control">
                                    <input class="input" v-model="user.email" type="email">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="columns">
                        <div class="column">
                            <div class="field">
                                <label class="label">Telefone Celular<span class="required">*</span></label>
                                <div class="control">
                                    <input class="input" v-model="user.phone" v-mask="'(##) #####-####'" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="column">
                            <div class="field">
                                <label class="label">Data de Nascimento<span class="required">*</span></label>
                                <div class="control">
                                    <input class="input" v-model="user.birthdate" type="date">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="columns">
                        <div class="column">
                            <div class="field">
                                <label class="label">CEP<span class="required">*</span></label>
                                <div class="control">
                                    <input class="input" v-model="user.zip_code" v-mask="'#####-###'" @change="getAddress()" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="column">
                            <div class="field">
                                <label class="label">Endereço<span class="required">*</span></label>
                                <div class="control">
                                    <input class="input" v-model="user.address" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="column">
                            <div class="field">
                                <label class="label">Bairro<span class="required">*</span></label>
                                <div class="control">
                                    <input class="input" v-model="user.neighborhood" type="text">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="columns">
                        <div class="column">
                            <div class="field">
                                <label class="label">Estado<span class="required">*</span></label>
                                <div class="control">
                                    <input class="input" v-model="user.uf" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="column">
                            <div class="field">
                                <label class="label">Cidade<span class="required">*</span></label>
                                <div class="control">
                                    <input class="input" v-model="user.city" type="text">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="has-text-right">
                        <button class="button is-primary" @click.self.prevent="saveUser">Cadastrar</button>
                    </div>
                </form>
            </div>
    </section>
    <script src="https://unpkg.com/vue@2.5.3/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue-resource@1.3.4"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue-the-mask@0.11.1/dist/vue-the-mask.min.js"></script>
    <script>
        new Vue({
            el: '#app',
            data: {
                user: {
                    name: '',
                    email: '',
                    phone: '',
                    birthdate: '',
                    zip_code: '',
                    address: '',
                    neighborhood: '',
                    uf: '',
                    city: ''
                },
                errors: '',
                message: ''
            },
            methods: {
                getAddress: function() {
                    this.$http.get('https://webmaniabr.com/api/1/cep/'+this.user.zip_code+'/?app_key=Dg7KOmSq1xByT6sYL7hqAZ5bvkuJ0Tud&app_secret=qB7vgIUb4Quv7u0zGrC0QjsMcpI2VU3kkjifQMaSlxvqOATk').then(response => {
                        this.user.address = response.body.endereco;
                        this.user.neighborhood = response.body.bairro;
                        this.user.uf = response.body.uf;
                        this.user.city = response.body.cidade;
                    }, response => {
                    });
                },
                saveUser: function() {
                    let token = document.getElementsByName("_token")[0].value;

                    this.$http.post('/save', this.user, 
                        {headers: {'X-CSRF-TOKEN': token}}).then(response => {
                            this.message = response.body.message;
                            setTimeout(function(){
                                location.reload();
                            }, 4000);
                    }, response => {
                        this.errors = response.body.errors;
                    });
                }
            },
        })
    </script>
    </body>
</html>
