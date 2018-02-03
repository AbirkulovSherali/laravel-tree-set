<template>
    <div id="chat">
        <div class="messages">
            <template v-for="message in messages">
                <p class="message">
                    <!-- <p class="data">{{ moment(Number(message.created_at)).fromNow() }}</p> -->
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
                auth: auth,
                moment: moment
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
                    console.log(data.message.from_user_id, data.message.to_user_id, this.toUserId);
                    if(data.message.from_user_id == this.toUserId){
                        this.messages.push(data.message);
                    }
                });

            axios.get('/chat/get-messages/' + auth.id + '/' + this.toUserId)
                .then((response) => {
                    this.messages = response.data;
                });

                console.log(moment(new Date().getTime()).fromNow());
        },

        methods: {
            sendMessage: function(){
                let message = {
                    'from_user_id': Number(auth.id),
                    'to_user_id': Number(this.toUserId),
                    'text': this.message,
                    'created_at': new Date().getTime()
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
