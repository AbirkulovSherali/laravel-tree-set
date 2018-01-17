<template>
    <div id="chat">
        <div class="messages">
            <template v-for="message in messages">
                <p class="message">
                    <span class="badge badge-success" v-if="message.from_user_id == auth.id">You</span>
                    <span class="badge badge-primary" v-else>{{ toUserName }}</span>
                    {{ message.text }}
                </p>
            </template>
        </div>
        <form @submit.prevent="sendMessage">
            <div class="form-group">
                <label for="message">Message:</label>
                <textarea class="form-control" v-model="message"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Send</button>
        </form>
    </div>
</template>

<script>

    export default {
        data: function() {
            return {
                message: '',
                messages: [],
                auth: auth
            }
        },

        props: {
            toUserName: {
                required: true
            },
            toUserId: {
                required: true
            },
        },

        mounted: function(){
            Echo.channel(`chat.${auth.id}`)
            .listen('SendMessage', (data) => {
                console.log(data);
                this.messages.push(data.message)
            });

            axios.get('/chat/get-messages/' + auth.id + '/' + this.toUserId)
                .then((response) => {
                    this.messages = response.data;
                })
        },

        methods: {
            sendMessage: function(){
                let message = {
                    'to_user_id': Number(this.toUserId),
                    'from_user_id': Number(this.fromUserId),
                    'text': this.message,
                };

                this.message = '';
                this.messages.push(message);

                axios.post('/chat/send-message', message)
                    .then((response) => {
                        console.log(response.data);
                    });
            }
        }
    }

</script>
