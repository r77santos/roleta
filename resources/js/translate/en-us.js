export default {
    language() {
        return 'en-us';
    },
    data() {
        return {
            header: {
                home: 'Home',
                example: 'Example 01',
                example2: 'Example 02',
                langs: {
                    'pt-br': 'PT-BR',
                    'en-us': 'English',
                }
            },
            hello: {
                title: 'Hello World!',
            },
            form: {
                name: 'Name',
                email: 'E-mail',
                telephone: 'Telephone',
                message: 'Message',
                send: 'Send'
            },
            footer: {
                home: 'Home',
            }
        };
    },
    element(key) {
        return this.data()[key];
    },
};