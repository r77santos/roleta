export default{

    language(){
        return 'pt-br';
    },

    data(){
        return{
            header: {
                home: 'Página inicial',
                example: 'Exemplo 01',
                example2: 'Exemplo 02',
                langs: {
                    'pt-br': 'PT-BR',
                    'en-us': 'English',
                }
            },
            hello:{
                title: 'Olá Mundo!',
            },
            form: {
               name: 'Nome', 
               email: 'E-mail',
               telephone: 'Telefone',
               message: 'Menssagem',
               send: 'Enviar'
            },
            footer: {
                home: 'Página inicial',
            }
        };
    },

    element(key) {
        return this.data()[key];
    },
};